<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class LabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $laba_rugi = DB::table("v_laba_rugi")->select("periode","keterangan","jumlah")->get();
            return response()->json(['status'=>1,'messages'=>'success', "data" => $laba_rugi], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($periode)
    {
        try {
            $laba_rugi = DB::table("v_laba_rugi")->select("periode","keterangan","jumlah")->where("periode",$periode)->get();
            return response()->json(['status'=>1,'messages'=>'success', "data" => $laba_rugi], 201);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }
}
