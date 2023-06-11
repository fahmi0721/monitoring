<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class BebanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $beban = DB::table("v_beban")->select("periode","keterangan","kode","akun","jumlah")->get();
            $cek_row = count($beban);
            if($cek_row > 0){
                return response()->json(['status'=>1,'messages'=>'success', "data" => $beban], 200);
            }else{
                return response()->json(['status'=>1,'messages'=>'data not found!', "data" => $beban], 200);
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
                $beban = DB::table("v_beban")->select("kode","akun","jumlah")->where("periode",$key)->get();
                $cek_row = count($beban);
                if($cek_row > 0){
                    return response()->json(['status'=>1,'messages'=>'success', "data" => $beban], 200);
                }else{
                    return response()->json(['status'=>1,'messages'=>'data not found', "data" => $beban], 200);
                }
            }elseif($filter == "akun"){
                $beban = DB::table("v_beban")->select("keterangan","akun","jumlah")->where("kode",$key)->get();
                $cek_row = count($beban);
                if($cek_row > 0){
                    return response()->json(['status'=>1,'messages'=>'success', "data" => $beban], 200);
                }else{
                    return response()->json(['status'=>1,'messages'=>'data not found!', "data" => $beban], 200);
                }
            }else{
                return response()->json(['status'=>0,'messages'=> "No data availible in api!", "data"=>array() ], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
