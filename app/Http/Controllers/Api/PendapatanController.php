<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pendapatan = DB::table("v_pendapatan")->select("periode","keterangan","kode","akun","jumlah")->get();
            $cek_row = count($pendapatan);
            if($cek_row > 0){
                return response()->json(['status'=>1,'messages'=>'success', "data" => $pendapatan], 200);
            }else{
                return response()->json(['status'=>1,'messages'=>'data not found!', "data" => $pendapatan], 200);
            }
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
    public function show(Request $request, $filter)
    {
        $key = $request->key;
        try {
            if($filter == "periode"){
                $pendapatan = DB::table("v_pendapatan")->select("kode","akun","jumlah")->where("periode",$key)->get();
                $cek_row = count($pendapatan);
                if($cek_row > 0){
                    return response()->json(['status'=>1,'messages'=>'success', "data" => $pendapatan], 200);
                }else{
                    return response()->json(['status'=>1,'messages'=>'data not found', "data" => $pendapatan], 200);
                }
            }elseif($filter == "akun"){
                $pendapatan = DB::table("v_pendapatan")->select("keterangan","akun","jumlah")->where("kode",$key)->get();
                $cek_row = count($pendapatan);
                if($cek_row > 0){
                    return response()->json(['status'=>1,'messages'=>'success', "data" => $pendapatan], 200);
                }else{
                    return response()->json(['status'=>1,'messages'=>'data not found!', "data" => $pendapatan], 200);
                }
            }else{
                return response()->json(['status'=>0,'messages'=> "No data availible in api!", "data"=>array() ], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);
        }
    }

}
