<?php

namespace App\Jobs;

use App\Services\DataFetcherFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;

class FetchModelDataJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Model $model) {}

    public function handle(DataFetcherFactory $factory): void
    {
        $fetcher = $factory->make($this->model);
        $data = $fetcher->fetch($this->model);
        $this->model->saveFetchedData($data);
    }
}
