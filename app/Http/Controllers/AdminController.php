<?php

namespace App\Http\Controllers;

use App\Models\AnalitiquesGeneralsModel;
use App\Models\AvisModel;
use App\Models\AvisUsuariModel;
use App\Models\ContingutModel;
use App\Models\User;
use App\Mail\blockUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function bloqueoCorreo($user) {
        $mail=$user->email;
        // return $user;
        $details = [
            'title'=>"Aviso de bloqueo de usuario",
            "body"=>"La cuenta '$user->name' ha sido bloqueada permanentemente",
            "motivos"=>"Exceso de contenido o comentarios inapropiados"
        ];
        Mail::to($mail)->send(new blockUser($details));
    }

    public function dashboard() {
        $conectados=User::where('actiu',1)->count();
        $desconectados=User::where('actiu',0)->count();
        $content=AnalitiquesGeneralsModel::all();
        $enperill=User::where('nivell_gravetat',"<",5)
            ->where("nivell_gravetat",">",0)
            ->count();
        $suspes=User::where('suspes',1)
            ->count();
        $sanos=User::where('nivell_gravetat',">=",5)
            ->count();
        return view('back.dashboard')
        ->with('content',$content)
        ->with('connected',$conectados)
        ->with('disconnected',$desconectados)
        ->with('sanos',$sanos)
        ->with('suspes',$suspes)
        ->with('enperill',$enperill);
    }

    public function adminify() {
        $users = DB::table('users')
        ->select('id','name','es_admin')->get();

        return view('back.adminify')->with('users',$users);
    }

    public function getBlocked() {
        $users = DB::table('users')
        ->select('id','name','suspes')->get();
        return view('back.bloqueado')->with('users',$users);
    }

    public function getUsersNotify() {
        $avis = AvisModel::all();
        $users = DB::table('users')
        ->select('users.id','users.name')
        ->where('suspes',0)
        ->get();
        $this->data = [
            "avis"=>$avis,
            "users"=>$users
        ];
        return view('back.notificacion')->with('users',$users)->with('data',$this->data);
    }

    public function getContent() {
        $content = ContingutModel::all();
        return view('back.adultify')->with('content',$content);
    }

    public function adultify(Request $request) {
        $id= $request->input('id');
        $val= $request->input('val');
        $content = ContingutModel::where('id',$id)
        ->update([
            'majoria_edat'=>$val
        ]);
        return 1;

    }

    public function getUsersNotifyList() {
        // Devuelve todos los avisos que tengan los usuarios y no esten aceptados
        $avis = DB::table('avis_usuari')
        ->select("users.id as idUser","users.name as name","avis.explicacio as explicacio","avis_usuari.id as id")
        ->join("users","users.id","=","avis_usuari.id_usuari")
        ->join("avis","avis.id","=","avis_usuari.id_avis")
        ->where('acceptat',0)
        ->orderBy("avis_usuari.id","desc")
        ->get();

        return view('back.notifyList')->with('avis',$avis);
    }

    public function makeAdmin(Request $request) {
        $id = $request->input('id');
        $aux= $request->input('aux');
        $tipus = ($aux==0) ? 1 : 2 ;
        $user = User::where('id',$id)
        ->update([
            'es_admin'=>$aux,
            'tipus'=>$tipus
        ]);
        if($user) {
            return 1;
        }
        return 0;

    }

    public function blockUser(Request $request) {
        $id = $request->input('id');
        $aux= $request->input('aux');

        $us =User::find($id);

        $nivell = ($aux==1) ? 0 : 10;
        $user = User::where('id',$id)
        ->update([
            'suspes'=>$aux,
            'nivell_gravetat'=>$nivell
        ]);

        if($aux==1) {
            $this->bloqueoCorreo(User::where('id',$id)->get()->first());
        }
        return 1;

    }

    public function insertNotify(Request $request) {
        $usuari=$request->input('user');
        $avis=$request->input('avis');
        $avisUsuari = AvisUsuariModel::create([
            "id_usuari"=>$usuari,
            "id_avis"=>$avis
        ]);
        if($avisUsuari) {
            return 1;
        }
        return 0;
    }

    public function acceptNotify(Request $request) {
        $id = $request->id;

        $update = AvisUsuariModel::where('id',$id)
        ->update([
            "acceptat"=>1
        ]);

        $avisUsuari = AvisUsuariModel::find($id);
        $gravetat = AvisModel::find($avisUsuari->id_avis);
        $idUser = $avisUsuari->id_usuari;
        $gravetat = $gravetat->gravetat;

        $user = User::find($idUser);
        $userGrav = $user->nivell_gravetat;

        // return $userGrav-$gravetat;

       if($userGrav-$gravetat>0) {
            $update = User::where('id',$idUser)
            ->update([
                "nivell_gravetat"=>$userGrav-$gravetat
            ]);
            return 1;
       }
        $update = User::where('id',$idUser)
        ->update([
            "suspes"=>1,
            "nivell_gravetat"=>0
        ]);

        $this->bloqueoCorreo($user);
        return 1;

    }

    public function deleteNotifyFromList(Request $request) {

        $id = $request->input('id');

        $tipus =DB::table('avis_usuari')
        ->where('id',$id)
        ->delete();
        return true;
    }

    public function getNotify() {
        $avis = AvisModel::select("id","explicacio")->get();
        return $avis;
    }
}
