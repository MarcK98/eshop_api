<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShopsWithCoordinates(){
        $shops = DB::table('shops')
            ->selectRaw("`name`, `image`, `color`, GROUP_CONCAT(`lat`, ',', `long` SEPARATOR '; ') as locations")
            ->leftJoin('locations', 'locations.shop_id', '=', 'shops.id')
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->groupBy('name', 'image', 'color')
            ->get();

        return response()->json(['status' => true, 'shops' => $shops]);
    }
}
