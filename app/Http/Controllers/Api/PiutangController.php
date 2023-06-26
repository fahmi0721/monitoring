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

    public function show_all_grafik(Request $request){
        $periode = $request->periode;
        $umur = $request->umur;
        $result = array();
        try {
            $result['v_bulan'] = $this->get_grafik_bulan($periode);
            $result['v_unit_kerja'] = $this->get_grafik_unit_kerja();
            $result['v_umur'] = $this->get_grafik_umur_piutang($umur);
            return response()->json(['status'=>1,'messages'=>'success', "data" => $result], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }

    private function get_grafik_bulan($tahun){
        try {
            $periode = DB::table("t_periode_tagihan")->where(DB::raw("RIGHT(periode,4)"),$tahun)->select("periode","keterangan")->get();
            $res = array();
            $result = array();
            $piutang = DB::table("v_piutan_bulan")->where(DB::raw("RIGHT(periode,4)"),$tahun)->select("keterangan","total","periode","total")->groupBy("periode")->orderBy("periode")->get();
            foreach ($periode as $i => $value) {
                $result['labels'][] = $value->keterangan;
                if($value->periode == $piutang[$i]->periode){
                    $result['data'][] = $piutang[$i]->total;
                }
            }
            return $result;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    private function get_grafik_unit_kerja(){
        try {
            $data = DB::table("v_piutang_unit_kerja")->select("*")->get();
            $result = array();
            foreach($data as $key => $dt){
                $result['labels'][] = $dt->ket_unit_kerja;
                $result['data'][] = $dt->total;
            }
            return $result;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    private function umurs($i){
        $res = array(
            "1s30" => array(1,30),
            "31s60" => array(31,60),
            "61s90" => array(61,90),
            "91s180" => array(91,180),
            "181s270" => array(181,270),
            "271s365" => array(181,270),
            "s365" => array(361,1000),
        );
        return $res[$i];
    }

    private function ket_umurs($i){
        $res = array(
            "1s30" => "1 s/d 30",
            "31s60" => "31 s/d 60",
            "61s90" => "61 s/d 90",
            "91s180" => "91 s/d 180",
            "181s270" => "181 s/d 270",
            "271s365" => "271 s/d 365",
            "s365" => ">365",
        );
        return $res[$i];
    }

    private function get_grafik_umur_piutang($umur){
        $umur = base64_decode($umur);
        $filter = $this->umurs($umur);
        try {
            $data = DB::table("v_piutang_umur")->whereBetween("umur_piutang",$filter)->select("nama_unit_kerja",DB::raw("ROUND(SUM(jumlah),0) as jumlah"))->groupBy("kode_unit_kerja")->orderBy("kode_unit_kerja")->get();
            $result = array();
            $result['umurs']= $this->ket_umurs($umur);
            foreach($data as $key => $dt){
                $result['labels'][] = $dt->nama_unit_kerja;
                $result['data'][] = $dt->jumlah;
            }
            return $result;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }
}
