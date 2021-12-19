<?php

namespace App\Http\Controllers;

use App\Models\TipusUsuariModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipusUsuariController extends Controller
{
    public function getAll() {
        $types = DB::table('tipus_usuari')->get();
        return view('back.typeCrud')->with('types',$types);
    }

    public function store(Request $request) {
        $request->validate([
            'tipus'=>'required'
        ]);
        $tipus=TipusUsuariModel::create([
            'tipus'=>$request->input('tipus')
        ]);
        $aux = ["correcte"=>$request->tipus];
        return redirect('/back/admin/tipususer')->with('resposta',$aux);
    }

    public function delete(Request $request) {
        $id = $request->input("id");

        // Para Evitar problemas de constraint cambiamos todos los
        // usuarios que tengan asociado el tipo asociado a el que se borra
        $update =User::where('tipus',$id)
        ->update([
            'tipus'=>1
        ]);

        $tipus =DB::table('tipus_usuari')
        ->where("id",$id)->delete();
        return true;
    }
}
