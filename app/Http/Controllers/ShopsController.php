<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShopsWithCoordinates(){
        $shops = DB::table('shops')
            ->select('shop_id', 'name', 'image', 'color', 'lat', 'long')
            ->leftJoin('locations', 'locations.shop_id', '=', 'shops.id')
            ->where('active', 1)
            ->whereNull('deleted_at')
//            ->groupBy('name')
            ->get();

        return response()->json(['status' => true, 'shops' => $shops]);
    }
}
