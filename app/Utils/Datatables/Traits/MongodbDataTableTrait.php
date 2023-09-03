<?php
namespace App\Utils\Datatables\Traits;


use App\Utils\Datatables\MongodbDataTable;

trait MongodbDataTableTrait
{
    /**
     * Get Mongodb DataTable instance for a model.
     *
     * @return MongodbDataTable
     */
    public static function dataTable()
    {
        return new MongodbDataTable(new static);
    }
}
