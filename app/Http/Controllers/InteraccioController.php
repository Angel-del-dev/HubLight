<?php

namespace App\Http\Controllers;

use App\Models\ContingutModel;
use App\Models\ContingutTagModel;
use App\Models\EstadisticaContingutModel;
use App\Models\InteraccioModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteraccioController extends Controller
{
    public function store(Request $request) {
        // dd($request);
        // return $request->all();

        $id_activo=Auth::user()->id;

        //1: recogemos el registro, si no existe lo crea y devuelve
        $interaccio=InteraccioModel::firstOrCreate([
            "id_usuari" => $id_activo,
            "id_contingut" => $request->input("id_contingut")
        ]);

        //2: rellenamos el objeto con los valores del request
        $interaccio->fill($request->all());
        // return $interaccio;

        //3: guardamos (update) el objeto
        $interaccio->save();
        // return $interaccio->id_contingut;

        if(null!==($request->input('megusta'))) {
            if($request->input('megusta')==1){
                $recomenats=ContingutTagModel::where('id_contingut',$interaccio->id_contingut)
                ->join('tags','tags.id',"=",'.id_tag')
                ->select("tags.nombre")
                ->get();
                $usuario = User::where('id',Auth::user()->id)->get()->first();
                $recomenatsRaw=explode(";",$usuario->recomenat);
                $recomenatsRaw=array_filter($recomenatsRaw);
                // $recomenatsRaw=array_filter($recomenatsRaw);
                $count=0;
                foreach($recomenats as $r){
                    foreach($recomenatsRaw as $rw) {
                        if($rw!=$r->nombre) {
                            $count++;
                        }
                    }
                    if($count==sizeof($recomenatsRaw)) {
                        // return $recomenatsRaw;
                        if(sizeof($recomenatsRaw)>30) {
                            array_pop($usuario->recomenat);
                            array_unshift($recomenatsRaw,$r->nombre);
                        }else {
                            array_unshift($recomenatsRaw,$r->nombre);
                        }
                    }
                    $count=0;
                }
                // return $recomenats;
                $recomenatsRaw=array_filter($recomenatsRaw);
                $recomenatsFinal=implode(';',$recomenatsRaw);
                if(sizeof($recomenatsRaw)>0) {
                    $user=User::where('id',Auth::user()->id)
                    ->update([
                        "recomenat"=>$recomenatsFinal
                    ]);
                }
            }
        }

        //4: devolvemos una respuesta response() con el valor que queramos
    }
    public function getComments($id) {
        $comments = InteraccioModel::where('interaccio.id_contingut',$id)
        ->join("contingut","contingut.id","=","interaccio.id_contingut")
        ->join("users","users.id","=","interaccio.id_usuari")
        ->orderBy("interaccio.created_at","desc")
        ->select("interaccio.id_usuari","users.name","interaccio.created_at","users.foto","interaccio.comentario")
        ->get();
        return $comments;
    }
}
