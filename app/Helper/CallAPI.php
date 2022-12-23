<?php 

namespace App\Helper;

use Illuminate\Support\Facades\Http;

class CallAPI{

    public function __construct(){
        $this->BASE_URL = env('BASE_URL_API');
    }

    public function get($endpoint){
        $url = $this->BASE_URL.$endpoint;

       
        $req = Http::get($url);
        
        return $req;
    }

}