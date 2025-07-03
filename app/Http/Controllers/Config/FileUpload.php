<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App;
use PDF;
use Auth;
use Storage;
use File;
class FileUpload extends Controller
{
    public function __construct()
	{
		//$this->middleware('auth');
	}

    public function main(Request $req, $id=null, $acc=null, $dta=null, $cmd=null){
        $path = storage_path('app/public/' . $req->get('page'));

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
	}

    public function saveView(Request $req){
        $valueJumlah        = \DB::table('app_view')->first();
        $jumlah             = @$valueJumlah->value_jumlah+1;
        if($jumlah >= $valueJumlah->jumlah_tambah){
            $update['total']        = @$valueJumlah->total+1;
            $update['value_jumlah'] = 0;
		    \DB::table('app_view')->update($update);
        }else{
            $update['value_jumlah'] = $jumlah;
		    \DB::table('app_view')->update($update);
        }

	}

    public function getView(){
        $cekJumlah = \DB::table('app_view')->orderBy('total', 'desc')->first();
        return @$cekJumlah->total;
    }
}
