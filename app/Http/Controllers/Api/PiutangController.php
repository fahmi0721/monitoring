<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = array();
        try {
            $peirode = DB::table("t_periode_tagihan")->where(DB::raw("RIGHT(periode,4)"),date("Y"))->select("periode","keterangan")->get();
            $res = array();
            $result = array();
            $piutang = DB::table("v_piutan_bulan")->where(DB::raw("RIGHT(periode,4)"), date("Y"))->select("keterangan","total","periode","total")->groupBy("periode")->orderBy("periode")->get();
            foreach ($peirode as $i => $value) {
                $result['labels'][] = $value->keterangan;
                if($value->periode == $piutang[$i]->periode){
                    $result['data'][] = $piutang[$i]->total;
                }
            }
            return response()->json(['status'=>1,'messages'=>'success', "data" => $result], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }
}
