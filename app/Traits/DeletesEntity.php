<?php

namespace App\Traits;

trait DeletesEntity
{
    public function deleteEntity($model, $id)
    {
        $model::findOrFail($id)->delete();

        return response()->json([
            'message' => class_basename($model) . ' berhasil dihapus'
        ]);
    }
}
