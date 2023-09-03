<?php

namespace App\Utils\Datatables;

use Jenssegers\Mongodb\Helpers\EloquentBuilder;
use Yajra\DataTables\EloquentDataTable;

class HybridMongodbQueryDataTable extends EloquentDataTable
{
    /**
     * Can the DataTable engine be created with these parameters.
     *
     * @param mixed $source
     * @return boolean
     */
    public static function canCreate($source)
    {
        return $source instanceof EloquentBuilder;
    }
}
