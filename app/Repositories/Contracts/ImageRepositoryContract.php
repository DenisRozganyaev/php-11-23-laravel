<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImageRepositoryContract
{
    public function attach(Model $model, string $relation, array $images = [], string $directory = null): void;
}
