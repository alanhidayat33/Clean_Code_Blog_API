<?php

namespace App\Traits;

trait UpdatesEntity
{
    public function updateEntity($model, $request, $id)
    {
        $data = $request->validated();
        $model::findOrFail($id)->update($data);

        return response()->json([
            'message' => class_basename($model) . ' berhasil diupdate'
        ]);
    }
}
