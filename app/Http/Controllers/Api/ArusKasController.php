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
            $datas = DB::table("v_arus_kas")
                    ->where("periode", $vl->periode)
                    ->select("saldo_awal","penerimaan","pengeluaran")
                    ->get();
            foreach ($datas as $i => $vla) {
                $iData['dataset']['data']['penerimaan'][] = $vla->penerimaan;
                $iData['dataset']['data']['pengeluaran'][] = $vla->pengeluaran;
                $iData['dataset']['data']['saldo_awal'][] = $vla->saldo_awal;
            }
        }
        return $iData;
    }
}
