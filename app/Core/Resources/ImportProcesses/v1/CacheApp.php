<?php
namespace App\Core\Resources\ImportProcesses\v1;

use App\Models\ImportProcess;
use App\Core\Resources\ImportProcesses\v1\Interfaces\ImportProcessesInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Core\Resources\ImportProcesses\v1\DBApp;
class CacheApp implements ImportProcessesInterface
{
    protected DBApp $dbApp;

    public function __construct(DBApp $dbApp ){
        $this->dbApp = $dbApp;
    }

    public function index()
    {

        /*$nameCache = '';

        (empty(request()->query())) ? $nameCache = 'import_process.get.all' : $nameCache = json_encode(request()->query());

        return Cache::store('redis')->tags('import_process')->rememberForever($nameCache, function () {
            return $this->dbApp->index();
        });*/

        return $this->dbApp->index();
    }

    /**
     * @throws \JsonException
     */
    public function get_relationship_import_records($import_process)
    {
/*
        $nameCache = '';

        (empty(request()->query())) ?
            $nameCache = "import_process.import-records--{$import_process->getRouteKey()}.get.all" :
            $nameCache = "import_process.import-records--{$import_process->getRouteKey()}.get.all" . json_encode(request()->query(), JSON_THROW_ON_ERROR);

        return Cache::store('redis')->tags('import_process')->rememberForever($nameCache, function () use ($import_process) {
            return $this->dbApp->get_relationship_import_records($import_process);
        });*/

        return $this->dbApp->get_relationship_import_records($import_process);
    }
}
