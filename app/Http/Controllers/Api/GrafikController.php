<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class GrafikController extends Controller
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
            $peirode = DB::table("t_data_pbl")->select("periode","keterangan")->get();
            $laba_rugi = $this->get_data_lr($peirode);
            $beban = $this->get_data_beban($peirode);
            $pendapatan = $this->get_data_pendapatan($peirode);
            foreach($peirode as $key => $dt){
                $labels[] = $dt->keterangan;
            }
            $result['labels'] = $labels;
            $result['laba_rugi'] = $laba_rugi;
            $result['beban'] = $beban;
            $result['pendapatan'] = $pendapatan;
            return response()->json(['status'=>1,'messages'=>'success', "data" => $result], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }

    private function get_data_lr($peirode){
        $res = array();
        $laba_rugi = DB::table("v_laba_rugi")->select("periode","jumlah")->get();
        foreach ($peirode as $i => $value) {
            if($value->periode == $laba_rugi[$i]->periode){
                $res[] = $laba_rugi[$i]->jumlah;
            }
        }
        return $res;
    }

    private function get_data_beban($peirode){
        $res = array();
        $beban = DB::table("v_beban")->select(DB::raw("SUM(jumlah) AS jumlah"),"periode")->groupBy("periode")->orderBy("periode")->get();
        foreach ($peirode as $i => $value) {
            if($value->periode == $beban[$i]->periode){
                $res[] = $beban[$i]->jumlah;
            }
        }
        return $res;
    }

    private function get_data_pendapatan($peirode){
        $res = array();
        $pendapatan = DB::table("v_pendapatan")->select(DB::raw("SUM(jumlah) AS jumlah"),"periode")->groupBy("periode")->orderBy("periode")->get();
        foreach ($peirode as $i => $value) {
            if($value->periode == $pendapatan[$i]->periode){
                $res[] = $pendapatan[$i]->jumlah;
            }
        }
        return $res;
    }

}
