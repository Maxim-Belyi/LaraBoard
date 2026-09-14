<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface DataFetcherInterface
{
    public function fetch(Model $model): array;
}
