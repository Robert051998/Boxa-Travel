<?php

namespace App\DataTables;

use App\Models\Discounts;
use Yajra\DataTables\Services\DataTable;

class DiscountsDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($discounts) {

                $edit = '<a href="' . url('admin/settings/edit-discounts/' . $discounts->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                $delete = '<a href="' . url('admin/settings/delete-discounts/' . $discounts->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Discounts::query();
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'amount', 'name' => 'discounts.amount', 'title' => 'Boxa Amount'])
            ->addColumn(['data' => 'value', 'name' => 'discounts.value', 'title' => 'Discount %'])
            ->addColumn(['data' => 'status', 'name' => 'discounts.status', 'title' => 'Status'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
             ->parameters(dataTableOptions());
    }

    protected function filename()
    {
        return 'discountsdatatables_' . time();
    }
}
