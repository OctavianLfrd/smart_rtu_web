<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class view extends Controller
{
    public function adlist () {
        // SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "ads_table"
        $thead =  DB::table("information_schema.columns")->select("column_name")
                                                         ->where("table_name", "ads_table")
                                                         ->get();
        $thead = json_decode($thead);
        $t = [];

        foreach ($thead as $th) {
            $t[] = preg_replace("/_/", " ", $th->column_name);
        }
        unset($thead);

        // SELECT * FROM ads_table
        $tbody = DB::table("ads_table")->get();

        return view("view", ["thead" => $t, "tbody" => $tbody]);
    }
}
