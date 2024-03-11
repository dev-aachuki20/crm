<?php

namespace App\DataTables\Lead;

use App\Models\Area;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {

                $html = '<div class="edit-delete">';
                $html .= datatableButton('edit', $data, auth()->user()->can('area_edit'));
                $html .= datatableButton('delete', $data, auth()->user()->can('area_delete'));
                $html .= '</div>';
                return $html;
            })

            ->editColumn('area_name', function ($data) {
                return '<div class="scroll-td">' . ucfirst($data->area_name) . '</div>';
            })

            ->editColumn('description', function ($data) {
                return '<div class="scroll-td">' . nl2br($data->description) . '</div>';
            })

            ->rawColumns(['action', 'area_name', 'description']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Area $model): QueryBuilder
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
        return 'Lead_' . date('YmdHis');
    }
}
