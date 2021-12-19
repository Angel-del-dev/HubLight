<?php

namespace App\Http\Controllers;

use App\Models\AnalitiquesGeneralsModel;
use App\Models\ContingutModel;
use App\Models\MissatgeModel;
use App\Models\SeguidorsModel;
use App\Models\User;
use App\Models\XatModel;
use App\Models\XatUsuarisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XatController extends Controller
{
    public function getChatsUser()
    {
        $xatUsers = XatUsuarisModel::where('xat_usuaris.id_usuari', Auth::user()->id)
            ->join('users', 'users.id', "=", "xat_usuaris.id_usuari")
            ->join('xat', 'xat.id', "=", "xat_usuaris.id_xat")
            ->select("users.foto", "xat_usuaris.id_usuari", "xat_usuaris.id_xat", 'xat.nom as nom_xat')
            ->get();

        foreach ($xatUsers as $x) {
            $x->integrantes = XatUsuarisModel::where('xat_usuaris.id_xat', $x->id_xat)
                ->join('users', 'users.id', '=', 'xat_usuaris.id_usuari')
                ->select("xat_usuaris.id_usuari", "users.foto", "users.name")
                ->get();

            $lastMessage = MissatgeModel::where('id_xat', $x->id_xat)->latest()->first("missatge");
            // $lastMessage=$lastMessage[sizeof($lastMessage)-1];
            $x->last_message = $lastMessage;
        }

        return $xatUsers;
    }

    public function getAmigos()
    {
        $usuarioActivo = Auth::user();
        $amigos = SeguidorsModel::whereRaw("(id_usuari = $usuarioActivo->id or id_seguit = $usuarioActivo->id) and  acceptat=1")
            ->join('users as u1', 'u1.id', '=', 'seguidors.id_usuari')
            ->get();
        $ids=[];
        foreach($amigos as $a) {
            $ids[]=($a->id_usuari==$usuarioActivo->id) ? $a->id_seguit : $a->id_usuari ;
        }
        $amigos=User::whereIn('id',$ids)
        ->select('id as id_user','name')
        ->get();
        $aux = [];
        return $amigos;
    }

    public function getAmigosNotChat($idXat)
    {
        $usersChat = XatUsuarisModel::where('id_xat', $idXat)->get();
        $aux = [];
        foreach ($usersChat as $u) {
            $aux[] = $u->id_usuari;
        }
        $usuarioActivo = Auth::user()->id;
        $amigos = SeguidorsModel::whereRaw("(id_usuari = $usuarioActivo or id_seguit = $usuarioActivo) and  acceptat=1")
            ->join('users as u1', 'u1.id', '=', 'seguidors.id_usuari')
            ->get();
        $ids=[];
        foreach($amigos as $a) {
           if(!in_array($a->id_usuari,$aux) || !in_array($a->id_seguit,$aux)) {
                $ids[]=($a->id_usuari==Auth::user()->id) ? $a->id_seguit : $a->id_usuari ;
           }
        }
        $amigos=User::whereIn('id',$ids)
        ->select('id as id_user','name')
        ->get();
        return $amigos;
    }

    public function getMissatges($idChat)
    {
        $missatges = MissatgeModel::whereRaw("missatge.id_xat = $idChat and missatge.id > xat_usuaris.lastseen and xat_usuaris.id_usuari=" . Auth::user()->id)
            ->join("users", "users.id", "=", "missatge.id_usuari")
            ->join("xat", "xat.id", "=", "missatge.id_xat")
            ->join("xat_usuaris", "xat_usuaris.id_xat", "=", "xat.id")
            ->select('missatge.*', 'users.name', 'users.foto')
            ->orderBy("id", "desc")
            // ->groupBy("missatge.id")
            ->get();

        if (sizeof($missatges) == 0) {
            return [];
        }

        foreach ($missatges as $m) {
            if ($m->id_contingut != null) {
                $contingut = ContingutModel::where('id', $m->id_contingut)
                    ->select('portada', 'url', 'tipus_contingut','majoria_edat')
                    ->get();
                $m->contingut = $contingut[0];
            }
        }

        $max = MissatgeModel::where('id_xat', $idChat)->latest('id')->first();
        $update = XatUsuarisModel::where(['id_usuari' => Auth::user()->id, 'id_xat' => $idChat])
            ->update([
                "lastseen" => $max->id
            ]);
        return $missatges;
    }

    public function getMissatgesAnteriores(Request $request)
    {
        $take = 10;
        $missatges = MissatgeModel::whereRaw("missatge.id_xat =  {$request->input('id_xat')} and missatge.id <= xat_usuaris.lastseen and xat_usuaris.id_usuari=" . Auth::user()->id)
            ->join("users", "users.id", "=", "missatge.id_usuari")
            ->join("xat", "xat.id", "=", "missatge.id_xat")
            ->join("xat_usuaris", "xat_usuaris.id_xat", "=", "xat.id")
            ->select('missatge.*', 'users.name', 'users.foto')
            ->take($take)
            ->skip($request->input('index') * $take)
            ->orderBy("id", "desc")
            ->get();


        if (sizeof($missatges) == 0) {
            return [];
        }

        foreach ($missatges as $m) {
            if ($m->id_contingut != null) {
                $contingut = ContingutModel::where('id', $m->id_contingut)
                    ->select('portada', 'url', 'tipus_contingut','majoria_edat')
                    ->get();
                $m->contingut = $contingut[0];
            }
        }

        $max = MissatgeModel::where('id_xat', $request->input('id_xat'))->latest('id')->first();
        $update = XatUsuarisModel::where(['id_usuari' => Auth::user()->id, 'id_xat' => $request->input('id_xat')])
            ->update([
                "lastseen" => $max->id
            ]);
        return $missatges;
    }

    public function storeMissatge(Request $request)
    {
        $missatge = MissatgeModel::create([
            "missatge" => $request->input("missatge"),
            "id_xat" => $request->input("id_xat"),
            "id_usuari" => Auth::user()->id
        ]);

        $actius = DB::table('analitiques_generals')->max('id');
        $analitiques = AnalitiquesGeneralsModel::find($actius);
        $aux2 = AnalitiquesGeneralsModel::where('id', $actius)
            ->update([
                "missatges_totals" => $analitiques->missatges_totals + 1
            ]);

        return $missatge;
    }

    public function sendContent(Request $request)
    {
        $xats = $request->input("id_xat");
        foreach ($xats as $x) {
            $missatge = MissatgeModel::create([
                "id_usuari" => Auth::user()->id,
                "missatge" => "",
                "id_contingut" => $request->input('id_contingut'),
                "id_xat" => $x
            ]);
        }
        return $missatge;
    }

    public function createChat(Request $request)
    {
        $req = $request->input('users');
        $create = 0;
        foreach ($req as $r) {
            $create = XatUsuarisModel::create([
                "id_xat" => $request->input('id_xat'),
                "id_usuari" => $r,
                "lastseen" => 0
            ]);
        }
    }

    public function startChat(Request $request)
    {
        $req = $request->input('users');
        $create = 0;
        $xat = XatModel::create([
            "nom" => ($request->input('nom') == null) ? '' : $request->input('nom'),
            "url_foto" => ''
        ]);
        foreach ($req as $r) {
            $create = XatUsuarisModel::create([
                "id_xat" => $xat->id,
                "id_usuari" => $r,
                "lastseen" => 0
            ]);
        }
    }
}
