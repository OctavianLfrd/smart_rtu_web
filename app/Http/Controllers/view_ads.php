<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class view_ads extends Controller
{
    private const thead = ["name", "owner", "type", "starts_at", "finishes_at", "priority", "enabled"];

    public function adList () {
        $response = DB::table("ads_table")->select(array_merge($this::thead, ["id"]))->get()->toJson();
        return $response;
    }

    public function deleteAds (Request $request) {
        if ($request->has("id")) {
            $id = is_array($request->input("id")) ? $request->input("id") : array($request->input("id"));
            $response = DB::table("ads_table")->select("name")->whereIn("id", $id)->get()->toJson();
            DB::table("ads_table")->whereIn("id", $id)->delete();
            return $response;
        }
    }

    public function updateAds (Request $request) {
        if ($request->has("id")) {
            $id = $request->input("id");
            $dataForUpdate = [];
            $dataForSelection = [];
            foreach ($this::thead as $index => $th) {
                if ($request->has($th)) {
                    $dataForUpdate[$th] = $request->input($th);
                    $dataForSelection[$index] = $th;
                }
            }
            DB::table("ads_table")->where("id", $id)->update($dataForUpdate);
            $response = DB::table("ads_table")->select($dataForSelection)->where("id", $id)->get()->toJson();
            return $response;
        }
    }

    public function sortAds (Request $request) {
        if ($request->has(["sortColumn", "sortDirection"])) {
            $sortColumn = $request->input("sortColumn");
            $sortDirection = $request->input("sortDirection");
            $response = DB::table("ads_table")->select(array_merge($this::thead, ["id"]))->orderBy($sortColumn, $sortDirection)->get()->toJson();
            return $response;
        }
    }

    public function getText (Request $request) {
        if ($request->has("id")) {
            $id = $request->input("id");
            $response = DB::table("ads_table")->select("text")->where("id", $id)->get()->toJson();
            return $response;
        }
    }
}
