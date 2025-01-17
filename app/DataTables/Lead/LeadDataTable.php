<?php

namespace App\DataTables\Lead;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class LeadDataTable extends DataTable
{

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable(
            $query->with(['createdBy', 'area', 'campaign'])->select('leads.*')))
            ->addColumn('action', function ($data) {
                $action='<div class="edit-delete">';
                if (Gate::check('leads_edit')) {
                    $editIcon = view('components.svg-icon', ['icon' => 'edit'])->render();
                    $action .= '<button title="'.trans('global.edit').'" class="edit-area edit-lead-btn" data-lead_id="'.$data->id.'" data-href="'.route('editLead', ['lead' => $data->id]).'">'.$editIcon.'</button>';
                }
                if (Gate::check('leads_delete')) {
                    $deleteIcon = view('components.svg-icon', ['icon' => 'delete'])->render();
                    $action .= '<form action="'.route('deleteLead', ['lead' => $data->id]).'" method="POST" class="deleteForm">
                    <button title="'.trans('global.delete').'" class="delete-area lead_delete_btn">'.$deleteIcon.'</button>
                    </form>';
                }
                $action .= '</div>';
                return $action;
            })
            ->editColumn('created_at', function ($data) {
                return convertDateTimeFormat($data->created_at,'fulldatetime');
            })
            ->editColumn('identification', function ($data) {
                // return $data->identification;
                $identification = '<a href="' . route('search', ['lang' => app()->getLocale(),'uuid' => $data->uuid]) . '">' . $data->identification . '</a>';

                return $identification;
            })
            ->editColumn('phone', function ($data) {
                return $data->phone;
            })
            ->editColumn('campaign.campaign_name', function ($data) {
                return $data->campaign ? $data->campaign->campaign_name : '';
            })
            ->editColumn('area.area_name', function ($data) {
                return $data->area ? $data->area->area_name : '';
            })
            ->editColumn('createdBy.name', function ($data) {
                return $data->createdBy ? $data->createdBy->name : '';
            })
        ->rawColumns(['action','identification']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lead $model): QueryBuilder
    {
        if(auth()->user()->is_vendor){
            $campaignIds = auth()->user()->campaigns()->pluck('id')->toArray();
            return $model->newQuery()->whereIn('campaign_id',$campaignIds);
        }
        
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dom =
            "<'row'<'col-sm-12 col-md-8'l><'col-sm-12 col-md-4'f>>" .
            "<'row'<'col-sm-12 table-responsive custome-responsive-table'tr>>" .
            "<'row d-md-none'<'col-sm-12 d-flex justify-content-end'p>>" .
            "<'d-none d-md-block'<'row'<'col-sm-12 d-flex justify-content-end'p>>>";

        return $this->builder()
            ->setTableId('lead-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom($dom)
            ->orderBy(0)
            ->parameters([
                "responsive" => true,
                // "scrollCollapse" => true,
                'autoWidth' => true,
                'searching' => true,
                'language' => [
                    "sZeroRecords" => __('cruds.data_not_found'),
                    "sProcessing" => __('cruds.processing'),
                    "sLengthMenu" => __('cruds.show') . " _MENU_ " . __('cruds.entries'),
                    "sInfo" => config('app.locale') == 'en' ?
                        __('message.showing') . " _START_ " . __('message.to') . " _END_ " . __('message.of') . " _TOTAL_ " . __('message.records') :
                        __('message.showing') . "_TOTAL_" . __('message.to') . __('message.of') . "_START_-_END_" . __('message.records'),
                    "sInfoEmpty" => __('message.showing') . " 0 " . __('message.to') . " 0 " . __('message.of') . " 0 " . __('message.records'),
                    "search" => __('cruds.search'),
                    "paginate" => [
                        "first" => __('message.first'),
                        "last" => __('message.last'),
                        "next" => __('cruds.next'),
                        "previous" => __('cruds.previous'),
                    ],
                    "autoFill" => [
                        "cancel" => __('message.cancel'),
                    ],
                ],
                // 'buttons'=> [
                //     [
                //         'extend'    => 'excelHtml5',
                //         'text'      => view('components.svg-icon', ['icon' => 'export-excel'])->render(),
                //         'titleAttr' => 'Excel',
                //         'exportOptions' => [
                //             'columns' => [1,2,3,4,5],
                //             'modifier' => [
                //                 'page' => 'all', 
                //             ]
                //         ]
                //     ],
                // ],
                // "lengthMenu"=> [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            ])
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [
            // Column::make('id')->exportable(false)->printable(false)->searchable(false)->visible(false),
            Column::make('created_at')->title(__('cruds.lead.fields.registration_date')),
            Column::make('identification')->title(__('cruds.lead.fields.identification')),
            Column::make('phone')->title(__('cruds.lead.fields.phone')),
            Column::make('campaign.campaign_name')->title(__('cruds.lead.fields.campaign')),
            Column::make('area.area_name')->title(__('cruds.lead.fields.area')),
            Column::make('createdBy.name')->title(__('cruds.lead.fields.created_by')),
        ];
        
        if(!auth()->user()->is_vendor){
            $columns[] = Column::computed('action')->title(__('global.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'); 
        }
        
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Lead_' . date('YmdHis');
    }
}
