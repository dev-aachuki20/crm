<?php

namespace App\DataTables\Interaction;


use App\Models\Interaction;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InteractionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable(
            $query->with(['createdBy', 'lead'])->select('interactions.*')))
            
            ->addColumn('action', function ($data) {
                $action='<div class="edit-delete">';
                if (Gate::check('interaction_edit')) {
                    $editIcon = view('components.svg-icon', ['icon' => 'edit'])->render();
                    $action .= '<button title="'.trans('global.edit').'" class="edit-interaction edit-interaction-btn" data-interaction_id="'.$data->id.'" data-href="'.route('interactions-edit', ['interaction' => $data->id]).'">'.$editIcon.'</button>';
                }
                if (Gate::check('interaction_delete')) {
                    $deleteIcon = view('components.svg-icon', ['icon' => 'delete'])->render();
                    $action .= '<form action="'.route('interactions-delete', ['interaction' => $data->id]).'" method="POST" class="deleteForm">
                    <button title="'.trans('global.delete').'" class="delete-interaction interaction_delete_btn">'.$deleteIcon.'</button>
                    </form>';
                }
                $action .= '</div>';
                return $action;
            })

            ->editColumn('registration_at', function ($data) {
                return $data->registration_at;
            })
            ->editColumn('lead.identification', function ($data) {
                return $data->lead->identification ?? null;
            })
            ->editColumn('lead.campaign.campaign_name', function ($data) {
                return $data->lead->campaign ? $data->lead->campaign->campaign_name : '';
            })

            ->editColumn('lead.area.area_name', function ($data) {
                return $data->lead->area ? $data->lead->area->area_name : '';
            })
           
            ->editColumn('lead.createdBy.name', function ($data) {
                return $data->createdBy ? $data->createdBy->name : '';
            })

            ->editColumn('qualification', function ($data) {
                return $data->qualification ? $data->qualification : '';
            })
        ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Interaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dom =
            "<'row'<'col-sm-12 col-md-8'lB><'col-sm-12 col-md-4'f>>" .
            "<'row'<'col-sm-12 table-responsive custome-responsive-table'tr>>" .
            "<'row d-md-none'<'col-sm-12 d-flex justify-content-end'p>>" .
            "<'d-none d-md-block'<'row'<'col-sm-12 d-flex justify-content-end'p>>>";

        return $this->builder()
            ->setTableId('interaction-table')
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
            ])
            ->selectStyleSingle()
            ->buttons(
                [
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload'),
                ]
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('id')->exportable(false)->printable(false)->searchable(false)->visible(false),
            Column::make('registration_at')->title(__('cruds.interaction.fields.registration_date')),
            Column::make('lead.identification')->title(__('cruds.interaction.fields.identification')),
            Column::make('lead.campaign.campaign_name')->title(__('cruds.interaction.fields.campaign')),
            Column::make('lead.area.area_name')->title(__('cruds.interaction.fields.area')),
            Column::make('lead.createdBy.name')->title(__('cruds.interaction.fields.created_by')),
            Column::make('qualification')->title(__('cruds.interaction.fields.qualification')),
            Column::computed('action')->title(__('global.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'interaction_' . date('YmdHis');
    }
}
