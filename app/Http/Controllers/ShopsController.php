<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShopsWithCoordinates(){
        $shops = DB::table('shops')
            ->select('name', 'image', 'color')
            ->join('locations', 'locations.shop_id', '=', 'shops.id')
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->get();

        return response()->json(['status' => true, 'shops' => $shops]);
    }
}
