<?php

namespace App\Http\Controllers;

use App\Helper\CallAPI;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->api = new CallAPI();
    }

    public function index(Request $req)
    {
        $tahun = $req->input('tahun');

        if($tahun != '') {
            // try {
                $res = $this->api->get('transaksi?tahun='.$tahun);
                $res_menu = $this->api->get('menu');

                $data = json_decode($res->body());
                $menu = json_decode($res_menu->body());

                $makanan = array();
                $new_menu = array();
                $total_tahun = array();
                $new_total = array();

                foreach($data as $key => $val){
                    $makanan[$val->menu][date('m', strtotime($val->tanggal))] = 0;
                    $total_tahun[date('m', strtotime($val->tanggal))] = 0;
                    $new_menu[$key][$val->menu][date('m', strtotime($val->tanggal))] = $val->total;
                    $new_total[$key][date('m', strtotime($val->tanggal))] = $val->total;  
                }
                
                foreach ($new_menu as $key => $val) {
                    foreach ($menu as $k => $value) {
                        for($a=1; $a<=12; $a++){
                            $no = str_pad($a, 2, '0', STR_PAD_LEFT); 
                            if(isset($makanan[$value->menu][$no]) && isset($val[$value->menu][$no])){
                                $makanan[$value->menu][$no] += $val[$value->menu][$no];
                            }
                           
                        }
                    }
                }

                foreach ($new_total as $key => $value) {
                    for($a=1; $a<=12; $a++){
                        $no = str_pad($a, 2, '0', STR_PAD_LEFT);
                        if(isset($total_tahun[$no]) && isset($value[$no])){
                            $total_tahun[$no] += $value[$no];
                        }
                    }
                }
                return view('welcome', compact('makanan','menu' , 'tahun', 'total_tahun'));  
            // } catch (\Throwable $th) {
            //     echo 'Koneksi API Gagal';
            // }
        } else {
            return view('welcome', compact('tahun'));            
        }
    }

    public function get_menu()
    {
        $res = $this->api->get('menu');
        $data = $res->body();

        echo $data;
    }

    public function get_trans($tahun)
    {   
        $res = $this->api->get('transaksi?tahun='.$tahun);
        $data = $res->body();
        echo $data;
    }
}
