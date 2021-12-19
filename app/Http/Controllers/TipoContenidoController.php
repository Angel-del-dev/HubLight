<?php

namespace App\Http\Controllers;

use App\Models\TipoContenidoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoContenidoController extends Controller
{
    public function getAll() {
        $tipoContenido = TipoContenidoModel::all();
        return $tipoContenido;
    }

    public function getTypeContent() {
        $tipo=TipoContenidoModel::all();
        // return $tipo;
        return view('back.typecontent')->with('data',$tipo);
    }

    public function store(Request $request) {
        // return $request;
        $tipoContent=TipoContenidoModel::create([
            "tipus"=>$request->input('tipus'),
            "espai"=>$request->input('espai'),
            "Descripcio"=>$request->input('Descripcio'),
            "icona"=>"test"
        ]);
        return redirect('/back/admin/tipocontent');
    }

    public function delete(Request $request) {
        $tipus =DB::table('tipus_contingut')
        ->where("id",$request->input("id"))->delete();
        return 1;
    }

    public function edit(Request $request) {
        $edit=TipoContenidoModel::where('id',$request->input('id'))
        ->update([
            $request->input('campo')=>$request->input('valor')
        ]);
    }
}
