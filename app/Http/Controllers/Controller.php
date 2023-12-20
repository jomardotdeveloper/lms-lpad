<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadFile($request, $file_name, $file_path) {
        $path = Storage::putFile("public/" . $file_path, $request->file($file_name));
        $path = Storage::url($path);
        return $path;
    }

    public function createLog($action, $user, $is_admin) {
        \App\Models\Log::create([
            'name' => $action,
            'user_id' => $user->id,
            'is_admin' => $is_admin
        ]);
    }

}
