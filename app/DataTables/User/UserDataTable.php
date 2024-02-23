<?php

namespace App\DataTables\User;

use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('roles.title', function ($data) {
                $roles = $data->roles;
                return $roles->pluck('title')->implode(', ');
            })
            ->addColumn('action', function ($data) {
                $html = '<div class="edit-delete">';
                $html .= datatableButton('edit', $data, auth()->user()->can('user_edit'));
                $html .= datatableButton('delete', $data, auth()->user()->can('user_delete'));
                $html .= '</div>';
                return $html;
            })
            ->editColumn('created_at', function ($data) {
                $datetimeString = $data->created_at;
                $dateTime = new DateTime($datetimeString);
                $formattedDateTime = $dateTime->format('d-m-Y/ H\hi');
                return $formattedDateTime;
            })

            ->filterColumn('roles.title', function ($query, $keyword) {
                $query->whereHas('roles', function ($subquery) use ($keyword) {
                    $subquery->where('title', 'like', '%' . $keyword . '%');
                });
            })

            ->filterColumn('created_at', function ($query, $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at, '%d-%m-%Y') like ?", ["%$keyword%"])
                        ->orWhereRaw("DATE_FORMAT(created_at, '%Hh%i') like ?", ["%$keyword%"])
                        ->orWhereRaw("DATE_FORMAT(created_at, '%d-%m-%Y/ %H\hi') like ?", ["%$keyword%"]);
                });
            })

            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $model = $model->newQuery()->with('roles');

        if (auth()->user()->is_super_admin) {
            $model = $model->whereHas('roles', function ($query) {
                //Not Super Admin
                $query->whereNotIN('id', [1]);
            });
        } elseif (auth()->user()->is_administrator) {
            $model = $model->whereHas('roles', function ($query) {
                //Not Super Admin and adminstrator
                $query->whereNotIN('id', [1, 2]);
            });
        } elseif (auth()->user()->is_supervior) {
            $model = $model->whereHas('roles', function ($query) {
                //Not Super Admin and Adminstrator
                $query->whereNotIN('id', [1, 2, 3]);
            });
        }

        return $model;
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
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom($dom)
            ->orderBy(0)
            ->parameters([
                "responsive" => true,
                "scrollCollapse" => true,
                'autoWidth' => true,
                // "scrollCollapse" => true,
                'language' => [
                    "sZeroRecords" => __('cruds.data_not_found'),
                    "sProcessing" => __('cruds.processing'),
                    "sLengthMenu" => __('cruds.show') . " _MENU_ " . __('cruds.entries'),
                    // "sInfo" => __('message.showing') . " _START_ " . __('message.to') . " _END_ " . __('message.of') . " _TOTAL_ " . __('message.records'),
                    "sInfo" =>  config('app.locale') == 'en' ?
                        __('message.showing') . " _START_ " . __('message.to') . " _END_ " . __('message.of') . " _TOTAL_ " . __('message.records') :
                        __('message.showing') . "_TOTAL_" . __('message.to') . __('message.of') . "_START_-_END_" . __('message.records'),
                    "sInfoEmpty" => __('message.showing') . " 0 " . __('message.to') . " 0 " . __('message.of') . " 0 " . __('message.records'),
                    "search" => __('cruds.search'),
                    "paginate" => [
                        "first" => __('message.first'),
                        "last" => __('message.last'),
                        "next" =>  __('cruds.next'),
                        "previous" =>  __('cruds.previous'),
                    ],
                    "autoFill" => [
                        "cancel" => __('message.cancel'),
                    ],

                ],
            ])

            // ->parameters([
            //     'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/'.getDatatableLang().'.json']
            // ])
            ->selectStyleSingle()
            ->lengthMenu([10, 25, 50, 100])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            // Column::make('id'),
            // Column::make('created_at')->title('Registration Date'),
            Column::make('created_at')->title(__("cruds.user.fields.registration_date")),
            Column::make('username')->title(__("cruds.user.fields.user_name")),
            Column::make('email')->title(__("cruds.user.fields.email")),
            Column::make('roles.title')->title(__("cruds.user.fields.role"))->sortable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title(__("global.action")),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
