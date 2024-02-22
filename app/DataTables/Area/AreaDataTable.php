<?php

namespace App\DataTables\Area;

use App\Models\Area;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AreaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                return '<div class="edit-delete">'
                    .(auth()->user()->can('area_edit') ?
                        '<button type="button" id="edit-area" class="edit-area" data-bs-toggle="modal" data-bs-target="#areastoreModal" onclick="editForm(' . $data->id . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.26 3.59997L5.04997 12.29C4.73997 12.62 4.43997 13.27 4.37997 13.72L4.00997 16.96C3.87997 18.13 4.71997 18.93 5.87997 18.73L9.09997 18.18C9.54997 18.1 10.18 17.77 10.49 17.43L18.7 8.73997C20.12 7.23997 20.76 5.52997 18.55 3.43997C16.35 1.36997 14.68 2.09997 13.26 3.59997Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.89 5.05005C12.32 7.81005 14.56 9.92005 17.34 10.2" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3 22H21" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        </button>' 
                    : '')
                    .(auth()->user()->can('area_delete') ?              
                        '<button type="button" class="delete-area" id="delete-area" onclick="deleteRecord(' . $data->id . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        </button>'
                    :'')
                .'</div>';
            })

            ->editColumn('area_name', function ($data) {
                return '<div class="scroll-td">'.ucfirst($data->area_name).'</div>';
            })

            ->editColumn('description', function ($data) {
                return '<div class="scroll-td">'.nl2br($data->description).'</div>';
            })

            ->rawColumns(['action','area_name','description']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Area $model): QueryBuilder
    {
        // return $model->newQuery()->orderByDesc('id');
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
            ->setTableId('area-table')
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
            Column::make('id')->exportable(false)->printable(false)->searchable(false)->visible(false),
            Column::make('area_name')->title(__('cruds.area.fields.name')),
            Column::make('description')->title(__('cruds.area.fields.description')),
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
        return 'Area_' . date('YmdHis');
    }
}