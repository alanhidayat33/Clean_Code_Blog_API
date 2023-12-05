<?php

namespace App\Traits;

trait CreatesEntity
{
    public function createEntity($model, $request)
    {
        $data = $request->validated();

        return $model::create($data);
    }
}
