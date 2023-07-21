<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class GrafikPblController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $result = array();
        try {
            $result['laba_rugi'] = $this->get_grafik_lb($tahun);
            $result['pendapatan'] = $this->get_grafik_pendapatan($tahun);
            $result['biaya'] = $this->get_grafik_biaya($tahun);
            return response()->json(['status'=>1,'messages'=>'success', "data" => $result], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);
        }
    }

    public function periode(Request $request){
        $res = DB::table("t_data_pbl")->where("periode",$request->periode)->select(DB::raw("keterangan as periode"))->first();
        return $res;
    }

    public function show(Request $request){
        $periode = $request->periode;
        $result = array();
        $row = array();
        try {
            $data_akun = DB::table("m_akun")->join("t_detail_data_pbl","m_akun.kode_akun","=","t_detail_data_pbl.akun_kode")->distinct()->get(["m_akun.nama_akun","m_akun.kode_akun","tipe"]);
            foreach($data_akun as $dt_akun){
                $result['nama_akun'] = $dt_akun->nama_akun;
                $result['kode_akun'] = $dt_akun->kode_akun;
                $result['tipe'] = $dt_akun->tipe;
                $result['jumlah'] = 0;
                $result['detail_data'] = array();
                $dt_detail = DB::table("t_detail_data_pbl")
                        ->join("m_sub_akun","t_detail_data_pbl.sub_akun_kode","=","m_sub_akun.kode_sub_akun")
                        ->join("t_data_pbl","t_detail_data_pbl.data_pbl_id","=","t_data_pbl.id")
                        ->select("m_sub_akun.nama_sub_akun","t_detail_data_pbl.jumlah",DB::raw("FORMAT(jumlah,0,'id_ID') as jml"))
                        ->where("t_data_pbl.periode", $periode)
                        ->where("t_detail_data_pbl.akun_kode", $dt_akun->kode_akun)
                        ->get(); 
                $result['detail_data'] = $dt_detail;
                $result['jumlah'] = $this->get_total($dt_detail);
                $row['data_pb'][]=$result;
                if($dt_akun->tipe == "p"){
                    $row['pendapatan'][] = $result['jumlah'];
                }else{
                    $row['beban'][] = $result['jumlah'];
                }
            }
            $row['laba_rugi'] = number_format((array_sum($row['pendapatan']) - array_sum($row['beban'])),0,',','.');
            return response()->json(['status'=>1,'messages'=> "load successfull", "data"=>$row ], 200);
        } catch (\QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);
        }
    }

    private function get_total($data){
        $res = 0;
        foreach($data as $dt){
            $res = $res + $dt->jumlah;
        }
        return $res;
    }

    private function get_grafik_lb($tahun){
        $result = array();
        $data = DB::table("v_laba_rugi")->where(DB::raw("RIGHT(periode,4)"), $tahun)->select("keterangan", "jumlah")->get();
        foreach ($data as $key => $res) {
            $result['labels'][] = $res->keterangan; 
            $result['data'][] = $res->jumlah; 
        }
        return $result;
    }
    private function rndRGBColorCode()
    {
        return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'; #using the inbuilt random function
    }
    private function get_grafik_pendapatan($tahun){
        $result = array();
        $periode = DB::table("t_data_pbl")->where(DB::raw("RIGHT(periode,4)"), $tahun)->select("periode","keterangan")->get();
        $dta['dataset']['label'] = [];
        $dta['dataset']['labelkode'] = [];
        $colors = array("#eb3b5a","#fa8231","#4b7bec","#20bf6b","#a55eea");
        foreach ($periode as $key => $res) {
            $result['labels'][] = $res->keterangan; 
            $data = DB::table("v_pendapatan")
                    ->where("periode", $res->periode)
                    ->select("jumlah","akun","kode")
                    ->get();
            foreach ($data as $ky => $dt) {
                $dta['dataset']['data'][$dt->kode][] = $dt->jumlah;
                if(!in_array($dt->kode, $dta['dataset']['labelkode'])){
                    $dta['dataset']['label'][] = $dt->akun;
                    $dta['dataset']['labelkode'][] = $dt->kode;
                    $dta['dataset']['color'][] = $this->rndRGBColorCode();
                }
                
            }
        }
        $result['dt_set'] = $this->generate_dataset($dta['dataset']);
        return $result;
    }

    private function get_grafik_biaya($tahun){
        $result = array();
        $periode = DB::table("t_data_pbl")->where(DB::raw("RIGHT(periode,4)"), $tahun)->select("periode","keterangan")->get();
        $dta['dataset']['label'] = [];
        $dta['dataset']['labelkode'] = [];
        $colors = array("#eb3b5a","#fa8231","#4b7bec","#20bf6b","#a55eea");
        foreach ($periode as $key => $res) {
            $result['labels'][] = $res->keterangan; 
            $data = DB::table("v_beban")
                    ->where("periode", $res->periode)
                    ->select("jumlah","akun","kode")
                    ->get();
            foreach ($data as $ky => $dt) {
                $dta['dataset']['data'][$dt->kode][] = $dt->jumlah;
                if(!in_array($dt->kode, $dta['dataset']['labelkode'])){
                    $dta['dataset']['label'][] = $dt->akun;
                    $dta['dataset']['labelkode'][] = $dt->kode;
                    $dta['dataset']['color'][] = $this->rndRGBColorCode();
                }
                
            }
        }
        $result['dt_set'] = $this->generate_dataset($dta['dataset']);
        return $result;
    }

    private function generate_dataset($dataset){
        $res = array();
        foreach ($dataset['labelkode'] as $key => $r) {
            $res[$key]['label'] = $dataset['label'][$key];
            $res[$key]['data'] = $dataset['data'][$r];
            $res[$key]['borderColor'] = $dataset['color'][$key];
            $res[$key]['backgroundColor'] = $dataset['color'][$key];
        }
        return $res;
    }
}

