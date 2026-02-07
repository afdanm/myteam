<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $user = Auth::user();
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function($row) use($user){
                $btn = "";
                if($user->can('User Role Create')){
                    $btn .= '<a href="'.route('user.role',$row->id).'" class="txt-primary m-1"><i data-feather="box"></i></a>';
                }
                if($user->can('User Update')){
                    $btn .= '<a href="'.route('user.edit',$row->id).'" class="txt-info m-1"><i data-feather="edit-3"></i></a>';
                }
                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $user = Auth::user();
        if($user->hasRole('Super Admin')){
            return $model->newQuery()->orderBy('id');
        }
        return $model->newQuery()->where('id', '!=', '1')->orderBy('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex'),
            Column::make('username'),
            Column::make('name'),
            Column::make('email'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
