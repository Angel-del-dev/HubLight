<?php
//Pdsnfskdfkd
namespace App\Http\Controllers;

use App\Mail\EmailPassword;
use App\Models\ContingutModel;
use App\Models\SeguidorsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuariController extends Controller
{
    public function getAll() {
        $results = DB::table('users')->get();
        return $results;
    }
    public function get($id) {
        // Seguidor bool
        $bool="0";
        if(isset(Auth::user()->id)) {
            $bool=SeguidorsModel::whereRaw("(id_seguit=".Auth::user()->id." and id_usuari=$id) or (id_seguit=$id and id_usuari=".Auth::user()->id.")")->get()->first();
            if(isset($bool->acceptat)) {
                if($bool->acceptat=="1") {
                    $bool="1";
                }else {
                    $bool="0";
                }
            }else {
                $bool="0";
            }
        }
        // return $bool;
        // Info seguidor
        // $bool=SeguidorsModel::whereRaw("id_seguit=$id or id_usuari=$id")->get();
        // $bool=(sizeof($bool)==0) ? false : true ;
        // Info de usuario
        $result = User::find($id);
        $resultAmistad=0;
        if(empty($result)) return redirect("/notfound");
        if(isset(Auth::user()->id)){
            $resultAmistad=SeguidorsModel::where('id_Usuari',Auth::user()->id)
            ->orWhere('id_usuari',$id)
            ->orWhere('id_seguit',$id)
            ->orWhere('id_seguit',Auth::user()->id)
            ->get();
            $resultAmistad=(empty($resultAmistad)) ? "0" : "1" ;
        }

        return view('front.perfil')
            ->with('user',$result)
            ->with('amistad', ($resultAmistad>0)?1:0)
            ->with('seguit',$bool);
    }

    public function getPublicaciones($idUser,$offset) {
        $take=30;
        $publicaciones=ContingutModel::where('propietari',$idUser)
        ->take($take)
        ->skip($offset*$take)
        ->get();
        return $publicaciones;
    }

    public function opciones($id) {
        $result = User::find($id);
        return view('front.opciones')->with('user',$result);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function update(Request $request) {
        $usuari = User::where('id',Auth::user()->id)
        ->update([
            "name"=>$request["name"],
            "email"=>$request["email"],
            "password"=>md5($request["password"])
        ]);
    }
    public function updateFoto(Request $request) {
        $nombre=Auth::user()->foto;
        $request->validate([
            'foto'=>'required|mimes:jpg,png,jpeg,gif|max:1024'
        ]);

        if($nombre!=="avatar.jpg") {
            unlink(public_path("/images/perfil/usuarios/$nombre"));
        }

        $newImageName=time().'-'.trim(Auth::user()->name).'.'.$request->foto->extension();

        $request->foto->move(public_path('/images/perfil/usuarios'),$newImageName);
        $usuari = User::where('id',Auth::user()->id)
        ->update([
            "foto"=>$newImageName
        ]);
        return redirect($request->ruta);
    }
    public function updatePerfil(Request $request) {

        $update=[];

        $nombre=Auth::user()->foto;
        $fondo=Auth::user()->fondo;
        $request->validate([
            'foto'=>'mimes:jpg,png,jpeg,gif|max:4096',
            'fondo'=>'mimes:jpg,png,jpeg,gif|max:4096'
        ]);
        // Foto perfil
        if(isset($request->foto)) {
            if($nombre!=="avatar.jpg") {
                unlink(public_path("/images/perfil/usuarios/$nombre"));
            }
            $avatar=time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$request->foto->extension();
            $update["foto"]=$avatar;
            $request->foto->move(public_path('/images/perfil/usuarios'),$avatar);
        }
        // Fondo
        if(isset($request->fondo)) {
            if($fondo!=="fondoDefault.jpg") {
                unlink(public_path("/images/perfil/usuarios/fondo/".Auth::user()->fondo));
            }
            $fondo=time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$request->fondo->extension();
            $update["fondo"]=$fondo;
            $request->fondo->move(public_path('/images/perfil/usuarios/fondo'),$fondo);
        }
        // Alies
        if(isset($request->alias)) {
            $alies=$request->alias;
            $update["alies"]=$alies;
        }
        if(isset($request->password)) {
            $update["password"]=Hash::make($request->input('password'));
        }
        // Update
        $usuari = User::where('id',Auth::user()->id)
        ->update($update);
        return redirect("/opciones/".Auth::user()->id);

    }
    public function verifica($id) {
        $mytime = Carbon::now();
        $user=User::where('id',$id)
        ->update([
            "email_verified_at"=>$mytime
        ]);
        return redirect('/');
    }

    public function genPassword(Request $request) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $charactersLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $user=User::where(["name"=>$request->input('name'),"email"=>$request->input('email')])->get();
        if(sizeof($user)==0)  return false ;
        $details = [
            'title'=>"Se ha cambiado su contraseña",
            "body"=>"Acuerdese de cambiarla desde opciones de su perfil, introduzca esta nueva contraseña: ".$randomString,
        ];
        User::where(["name"=>$request->input('name'),"email"=>$request->input('email')])
        ->update([
            "password"=>Hash::make($randomString)
        ]);
        Mail::to($request->input('email'))->send(new EmailPassword($details));
        return true;
    }
}
