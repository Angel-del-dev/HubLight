<?php

namespace App\Http\Controllers;

use App\Models\AvisModel;
use App\Models\AvisUsuariModel;
use App\Models\InteraccioModel;
use App\Models\SeguidorsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguidorsController extends Controller
{
    public function store(Request $request) {
        $request=$request->all();
        $seguidors=SeguidorsModel::create([
            "id_usuari"=>Auth::user()->id,
            "id_seguit"=>$request["seguit"]
        ]);
    }

    public function edit(Request $request) {
        $request=$request->all();
        $seguidors=SeguidorsModel::where('id',$request["id"])
        ->update([
            "acceptat"=>1
        ]);
    }

    public function getNotificaciones() {
        $notificaciones=[];
        $seguidors=SeguidorsModel::where(['id_seguit'=>Auth::user()->id,"acceptat"=>0])
            ->join("users","users.id","=","id_usuari")
            ->select("seguidors.id","users.name")
            ->get();
        foreach($seguidors as $s) {
            $s->tipo="amistad";
        }
        $interaccions=InteraccioModel::where(['visto'=>0,'contingut.propietari'=>Auth::user()->id])
        ->join("contingut","contingut.id","=","id_contingut")
        ->select("interaccio.*")
        ->get();
        foreach($interaccions as $i) {
            $i->tipo="interaccion";
        }
        $avis_usuari=AvisUsuariModel::where(['id_usuari'=>Auth::user()->id,"acceptat"=>1,"avis_usuari.removed"=>0])
        ->join("avis","avis.id","=","id_avis")
        ->select("avis_usuari.id","avis.explicacio")
        ->get();
        foreach($avis_usuari as $a) {
            $a->tipo="aviso";
        }
        array_push($notificaciones,$seguidors);
        array_push($notificaciones,$interaccions);
        array_push($notificaciones,$avis_usuari);
        return $notificaciones;

    }

    public function acceptNotificacion($id,Request $request) {
        if($request->input('tipo')=="amistad") {
            $amistad=SeguidorsModel::where('id',$request->input('id'))
            ->update([
                "acceptat"=>1
            ]);
        }else if($request->input('tipo')=="interaccion"){
            $interaccion=SeguidorsModel::where('id',$request->input('id'))
            ->update([
                "visto"=>1
            ]);
        }
        return 1;

    }

    public function deleteNotificacion($id,Request $request) {
        if($request->input('tipo')=="amistad") {
            $amistad=SeguidorsModel::where('id',$request->input('id'))
            ->delete();
        }else if($request->input('tipo')=="aviso"){
            $interaccion=AvisUsuariModel::where('id',$request->input('id'))
            ->update([
                "removed"=>1
            ]);
        }else if($request->input('tipo')=="interaccion") {
            $interaccion=InteraccioModel::where('id',$request->input('id'))
            ->update([
                "visto"=>1
            ]);
        }
        return 1;
    }
}
