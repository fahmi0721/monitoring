<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\QueryException;

class ArusKasController extends Controller
{
    public function index()
    {
        try {
            $arus_kas = DB::table("t_periode_sumber_arus_kas")->where(DB::raw("RIGHT(periode,4)"),date("Y"))->select("id","periode","saldo_awal","keterangan")->get();
            $cek_row = count($arus_kas);
            if($cek_row > 0){
                $iData = $this->generate_data($arus_kas);
                return response()->json(['status'=>1,'messages'=>'success', "data" => $iData], 200);
            }else{
                return response()->json(['status'=>1,'messages'=>'data not found!', "data" => $arus_kas], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }

    private function rndRGBColorCode()
    {
        return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'; #using the inbuilt random function
    }

    private function generate_data($data){
        $iData = array();
        foreach ($data as $key => $vl) {
            $iData['labels'][] = $vl->keterangan;
            $iData['dataset']['color']['penerimaaan'] = $this->rndRGBColorCode();
            $iData['dataset']['color']['pengeluaran'] = $this->rndRGBColorCode();
            $iData['dataset']['color']['saldo_awal'] = $this->rndRGBColorCode();
            $iData['dataset']['color']['saldo_akhir'] = $this->rndRGBColorCode();
            $datas = DB::table("v_arus_kas")
                    ->where("periode", $vl->periode)
                    ->select("saldo_awal","penerimaan","pengeluaran")
                    ->get();
            foreach ($datas as $i => $vla) {
                $iData['dataset']['data']['penerimaan'][] = $vla->penerimaan;
                $iData['dataset']['data']['pengeluaran'][] = $vla->pengeluaran;
                $iData['dataset']['data']['saldo_awal'][] = $vla->saldo_awal;
                $iData['dataset']['data']['saldo_akhir'][] = $vla->saldo_awal + ($vla->penerimaan-$vla->pengeluaran);
            }
        }
        return $iData;
    }

    public function get_grafik(Request $requst){
        $tahun = $requst->tahun;
        try {
            $result = array();
            $result['saldo_awal'] = $this->get_data_grafik_saldo_awal($tahun);
            $result['penerimaan'] = $this->get_data_grafik_arus_kas("penerimaan",$tahun);
            $result['pengeluaran'] = $this->get_data_grafik_arus_kas("pengeluaran",$tahun);
            return response()->json(['status'=>1,'messages'=>'success', "data" => $result], 200);
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);
        }
    }
    
    public function get_data_grafik_arus_kas($kategori,$tahun){
        $result = array();
        $dt = array();
        $result['dataset']['labelkode'] = array();
        $periodes = DB::table("t_periode_sumber_arus_kas")->where(DB::raw("RIGHT(periode,4)"), $tahun)->select("periode","keterangan")->get();
        foreach ($periodes as $key => $periode) {
            $dt['labels'][] = $periode->keterangan;
            $dt_datas = DB::table("v_detail_arus_kas")->where("periode", $periode->periode)->select($kategori,"nama_arus_kas","arus_kas_kode")->get();
            foreach ($dt_datas as $i => $val) {
                $result['dataset']['data'][$val->arus_kas_kode][] = $val->$kategori;
                if(!in_array($val->arus_kas_kode, $result['dataset']['labelkode'])){
                    $result['dataset']['label'][] = $val->nama_arus_kas;
                    $result['dataset']['labelkode'][] = $val->arus_kas_kode;
                    $result['dataset']['color'][] = $this->rndRGBColorCode();
                }
            }
        }
        $dt['dt_set'] = $this->generate_dataset($result['dataset']);
        return $dt;
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

    public function get_data_grafik_saldo_awal($tahun){
        $result = array();
        try {
            $query = DB::table("t_periode_sumber_arus_kas")->where(DB::raw("RIGHT(periode,4)"), $tahun)->select("keterangan","saldo_awal")->get();
            foreach ($query as $key => $dt) {
                $result['labels'][] = $dt->keterangan;
                $result['data'][] = $dt->saldo_awal;
            }
            return $result;
        } catch (QueryException $e) {
            return response()->json(['status'=>0,'messages'=> $e->getMessage(), "data"=>array() ], 500);

        }
    }
}
