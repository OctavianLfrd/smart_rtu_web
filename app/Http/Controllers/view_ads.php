<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class view_ads extends Controller
{
    private const thead = ["name", "owner", "type", "starts_at", "finishes_at", "priority", "enabled"];

    public function adList () {
        $response = DB::table("ads_table")->select(array_merge($this::thead, ["id"]))->get()->toJson();
        echo $response;
    }

    public function deleteAds (Request $request) {
        if ($request->has("ads")) {
            $recordsForDeletion = is_array($request->input("ads")) ? $request->input("ads") : array($request->input("ads"));
            $response = DB::table("ads_table")->select("name")->whereIn("id", $recordsForDeletion)->get()->toJson();
            DB::table("ads_table")->whereIn("id", $recordsForDeletion)->delete();
            return $response;
        }
    }

    public function updateAds (Request $request) {
        if ($request->has("id")) {
            $id = $request->input("id");
            $dataForUpdate = [];
            foreach ($this::thead as $th) {
                if ($request->has($th))
                    $dataForUpdate[$th] = $request->input($th);
            }
            DB::table("ads_table")->where("id", $id)->update($dataForUpdate);
        }
    }
}
