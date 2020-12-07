<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getAppStatus(Request $request)
    {
        try {

            $settings = DB::table('settings')->orderBy('id', 'desc')->first();

            $data = [
                'status' => true,
                'version' => $settings->id,
                'minimum_version' => array(
                    'ios' => $settings->min_version_ios,
                    'android' => $settings->min_version_android
                ),
                'maintenance' => json_decode($settings->maintenance, false)
            ];


            return Response::json($data, 200);

        } catch (\Exception $e) {
            report($e);
            return Response::json($e->getMessage(), 500);
        }

    }
}
