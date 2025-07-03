<?php

namespace App\Http\Controllers;

use App\Models\TemplateSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateSertifikatController extends Controller
{

    public function index()
    {
        $template = TemplateSertifikat::select()->first();
        return view('pages.template.sertifikat.index', compact('template'));
    }

    public function store(Request $request){

        // return true;

        if (!empty($request->file('template_file'))) {
            TemplateSertifikat::truncate();
            $simpan         = array();
            $photo          = $request->file('template_file');
            $extension      = $photo->getClientOriginalExtension();
            $fileName       = date('Ymdhis').rand(11111,99999).'.'.$extension;
            $path           = $photo->storeAs('public/template', 'template-'.$fileName);
            $simpan['file']   = str_replace('public/', '', $path);
            TemplateSertifikat::create($simpan);
        }

        return true;

    }
}
