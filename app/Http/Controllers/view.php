<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class view extends Controller
{
    public function adlist () {
        $thead =  DB::table("information_schema.columns")->select("column_name")
                                                         ->where("table_name", "ads_table")
                                                         ->get();
        $thead = json_decode($thead);

        return view("view", ["thead" => $thead]);
    }

    public function listAds () {
        $tbody = DB::table("ads_table")->take(10)->get()->toJson();
        echo $tbody;
    }

    public function listAdsByPage ($page = 1) {
        $tbody = DB::table("ads_table")->skip(($page - 1) * 10)->take(10)->get()->toJson();
        echo $tbody;
    }

    public function deleteAds (Request $request) {
        if($request->has("ads")) {
            $del_recs = $request->input("ads");
            $query = null;

            // foreach ($del_recs as $key => $rec) {
                $query = DB::table("ads_table")->select("id", "name")->whereRaw("id IN (" . implode($del_recs, ", ") . ")")->get()->toJson();
                DB::table("ads_table")->whereRaw("id IN (" . implode($del_recs, ", ") . ")")->delete();
            // }

            return $query;
        }
    }
}
