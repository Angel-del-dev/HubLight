<?php

namespace App\Http\Controllers;

use App\Models\AnalitiquesGeneralsModel;
use App\Models\ContingutModel;
use App\Models\ContingutTagModel;
use App\Models\InteraccioModel;
use App\Models\SeguidorsModel;
use App\Models\TagsModel;
use App\Models\TipoContenidoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContingutController extends Controller
{

    public function getHome($offset) {
        $content=AnalitiquesGeneralsModel::all();
        $content = $content[sizeof($content)-1];
        $last_data=$content->created_at;
        // Cada dia crea unas estadisticas generales nuevas
        $last_data = explode("T",$last_data);
        $last_data = $last_data[0];
        $last_data = explode("-",$last_data);
        $last_data = (int)$last_data[2];
        $now=(int)date("d");

        if($now-$last_data>=1){
            $new_statistic=AnalitiquesGeneralsModel::create([
                "usuaris_suspes"=>$content->usuaris_suspes,
                "contenido_total"=>$content->contenido_total,
                "missatges_totals"=>$content->missatges_totals,
                "usuaris_actius"=>$content->usuaris_actius,
                "usuaris_enperill"=>$content->usuaris_enperill
            ]);
        }
        $seguits=SeguidorsModel::whereRaw('acceptat=1 and (id_seguit='.Auth::user()->id.' or id_usuari='.Auth::user()->id.')')
            ->select("id_seguit","id_usuari")
        ->get();
        // q_likes y si usuario ya le ha dado like
        $array=[];

        foreach($seguits as $s) {
            if($s->id_usuari!=Auth::user()->id) {
                $array[]=$s->id_usuari;
            }else  {
                $array[]=$s->id_seguit;
            }
        }

        $destacados=InteraccioModel::selectRaw(
            "id_contingut, count(megusta) as q_likes"
        )
        ->where("megusta","1")
        ->groupBy("id_contingut")
        ->get();
        foreach($destacados as $d) {
            $array[]=$d->id_contingut;
        }

        $take=5;

        $destacadosContenido=ContingutModel::whereIn("contingut.propietari",$array)
        ->join('users','users.id','=','propietari')
        ->select(
            "contingut.id as contingut_id",
            "titulo",
            "portada",
            "link_copyright",
            "url",
            "descripcio",
            "majoria_edat",
            "reportat",
            "propietari",
            "tipus_contingut",
            "drets_autor",
            "name",
            "password",
            "email",
            "foto",
            "link",
            "contingut.created_at"
        )
        ->orderBy("contingut.created_at","desc")
        ->take($take)
        ->skip($offset*$take)
        ->get();

        // $aux0=[];
        // foreach($destacados as $d) {
        //     $aux0[]=$d->id_contingut;
        // }

        // $likes=InteraccioModel::whereIn('id_contingut',$aux0)
        // ->selectRaw('count(megusta) as likes ,id_contingut')
        // ->groupBy("id_contingut")
        // ->orderBy("likes","desc")
        // ->get();

        $user=(isset(Auth::user()->id)) ? Auth::user()->id : 1;
        $ifLike=InteraccioModel::where(
            "id_usuari",$user

        )
        ->select("id_contingut","megusta")
        ->get();

        $bool="0";
        $qL=0;

        for($i=0;$i<sizeof($destacadosContenido);$i++) {
            $id_contingut=$destacadosContenido[$i]->contingut_id;
            for($j=0;$j<sizeof($ifLike);$j++) {
                $id_cont_child=$ifLike[$j]->id_contingut;
                if($id_contingut==$id_cont_child) {
                    $bool=$ifLike[$j]->megusta;
                }
            }

            for($j=0;$j<sizeof($destacados);$j++) {
                $id_cont_child=$destacados[$j]->id_contingut;
                if($id_contingut===$id_cont_child) {
                    $qL=$destacados[$j]->q_likes;
                }
            }

            $destacadosContenido[$i]->q_likes=$qL;

            $destacadosContenido[$i]->like_bool=$bool;
            $bool="0";
            $qL=0;
        }
        return $destacadosContenido;
    }

    public function getAll($offset) {
        $take=30;
        $results = DB::table('contingut')
        ->select('contingut.id','portada', 'link_copyright', 'url', 'descripcio', 'majoria_edat', 'reportat', 'users.name as propietario', 'tipus_contingut', 'drets_autor','contingut.created_at', 'contingut.updated_at')
        ->join('users','users.id','=','contingut.propietari')
        ->orderBy('created_at',"desc")
        ->skip($offset*$take)->take($take)
        ->get();
        return $results;
        // return view ('front.explorar')->with('results',$results);
    }
    public function get($id) {

        $propietari=ContingutModel::where('id',$id)->get()->first();
        // return $propietari;
        if(!isset($propietari->propietari)) return redirect('/notfound');
        if(isset(Auth::user()->id)) {
            if(Auth::user()->id==$propietari->propietari) {
                $interaccio=InteraccioModel::where('id_contingut',$id)
                ->update([
                    "visto" => 1
                ]);
            }
        }

        $q_likes=InteraccioModel::where(['id_contingut'=>$id,'megusta'=>1])
        ->count() ;

        $resultAmistad=[];
        $like=0;
        $results = DB::table('contingut')
        ->select('contingut.id','portada','contingut.titulo', 'link_copyright', 'url', 'descripcio', 'majoria_edat', 'users.id as id_user','users.foto as foto_perfil','users.name as propietario', 'tipus_contingut', 'drets_autor', 'contingut.created_at')
        ->join('users','users.id','=','contingut.propietari')
        ->where('contingut.id',$id)
        ->get();

        $id_user=DB::table('users')
        ->select('users.id')
        ->join('contingut','contingut.propietari','=','users.id')
        ->where(['contingut.id'=>$id])
        ->get();
        $id_user=$id_user[0]->id;

        // Comprueba si el usuario logueado le ha dado megusta
        if(isset(Auth::user()->id)) {
            $like=InteraccioModel::where(['id_contingut'=>$id,"id_usuari"=>Auth::user()->id])->get()->first();
            $like=(empty($like) || $like->megusta==0) ? 0 : 1;
        }
        // Devuelve los comentarios de la publicación
        $comment=InteraccioModel::where('id_contingut',$id)
        ->join("contingut","contingut.id","=","id_contingut")
        ->join("users","users.id","=","id_usuari")
        ->orderBy('interaccio.created_at','desc')
        ->select("interaccio.created_at","users.foto","interaccio.comentario","interaccio.id_usuari")
        ->get();
        // Comprueba si los usuarios son amigos
        if(isset(Auth::user()->id)){
            $resultAmistad=SeguidorsModel::where('id_Usuari',Auth::user()->id)
            ->orWhere('id_usuari',$id_user)
            ->orWhere('id_seguit',$id_user)
            ->orWhere('id_seguit',Auth::user()->id)
            ->get();
        }
        // Devuelve los tags del contenido
        $tags=ContingutModel::where('id_contingut',$id)
        ->join('contingut_tag','contingut_tag.id_contingut','=','contingut.id')
        ->join('tags','tags.id','=','contingut_tag.id_tag')->get('nombre');

        return view('front.contenido')
            ->with('results',$results[0])
            ->with('amistad', (sizeof($resultAmistad)>0)?1:0)
            ->with('tags',$tags)
            ->with('comentarios',$comment)
            ->with('like',$like)
            ->with('q_likes',$q_likes);
    }

    public function getRecomendados($offset) {
        $auth=Auth::user()->id;
        $info=User::where('id',$auth)->get();
        $recomenatsListRaw=$info[0]->recomenat;
        $recomenatsListArray=explode(';',$recomenatsListRaw);
        $recomenatsListArray=array_filter($recomenatsListArray);
        // return $recomenatsListArray;

        $take = 30;
        $recomendados = ContingutModel::
        whereIn("tags.nombre",$recomenatsListArray)
        ->join("contingut_tag","contingut_tag.id_contingut","=","id")
        ->join("tags","tags.id","=","contingut_tag.id_tag")
        ->skip($offset*$take)->take($take)
        ->orderBy("contingut.id","desc")
        ->selectRaw("distinct contingut.*")
        ->get();
        return $recomendados;
        // return view('front.recomendados')->with('info',$info);
    }

    public function getDestacados() {

        $limit=ContingutModel::all()->count();

        $limit = ceil($limit/10);

        $array=[];

        $destacados=InteraccioModel::selectRaw(
            "id_contingut, count(megusta) as q_likes"
        )
        ->where("megusta","1")
        ->groupBy("id_contingut")
        ->limit($limit)
        ->orderBy("q_likes","desc")
        ->get();
        foreach($destacados as $d) {
            $array[]=$d->id_contingut;
        }
        $destacadosContenido=ContingutModel::whereIn("contingut.id",$array)
        ->join('users','users.id','=','propietari')
        ->select(
            "contingut.id as contingut_id",
            "titulo",
            "portada",
            "link_copyright",
            "url",
            "descripcio",
            "majoria_edat",
            "reportat",
            "propietari",
            "tipus_contingut",
            "drets_autor",
            "name",
            "password",
            "email",
            "foto",
            "link",
            "contingut.created_at"
        )
        ->get();

        $aux0=[];
        foreach($destacados as $d) {
            $aux0[]=$d->id_contingut;
        }

        $likes=InteraccioModel::whereIn('id_contingut',$aux0)
        ->limit($limit)
        ->selectRaw('count(megusta) as likes ,id_contingut')
        ->groupBy("id_contingut")
        ->orderBy("likes","desc")
        ->get();

        $user=(isset(Auth::user()->id)) ? Auth::user()->id : 1;
        $ifLike=InteraccioModel::where(
            "id_usuari",$user

        )
        ->select("id_contingut","megusta")
        ->get();

        $bool="0";
        $qL=0;

        for($i=0;$i<sizeof($destacadosContenido);$i++) {
            $id_contingut=$destacadosContenido[$i]->contingut_id;
            for($j=0;$j<sizeof($ifLike);$j++) {
                $id_cont_child=$ifLike[$j]->id_contingut;
                if($id_contingut==$id_cont_child) {
                    $bool=$ifLike[$j]->megusta;
                }
            }

            for($j=0;$j<sizeof($destacados);$j++) {
                $id_cont_child=$destacados[$j]->id_contingut;
                if($id_contingut===$id_cont_child) {
                    $qL=$destacados[$j]->q_likes;
                }
            }

            $destacadosContenido[$i]->q_likes=$qL;

            $destacadosContenido[$i]->like_bool=$bool;
            $bool="0";
            $qL=0;
        }
        return $destacadosContenido;

    }

    public function getDestacadosVista() {
        return view('front.destacados');
    }

    public function buscador() {

        $resultados=[];
        $users=User::get(['id','name']);
        $cont=ContingutModel::whereNotNull('titulo')->get(['id','titulo']);

        $tags=TagsModel::get(['id',"nombre"]);

        array_push($resultados,$users);
        array_push($resultados,$cont);
        array_push($resultados,$tags);
        return $resultados;
    }

    public function store(Request $request) {

        $typeContent=$request->input('tipoC');
        $titulo=$request->input('titol');
        $tags = explode(",",$request->input('tags'));
        $rights=$request->input('derechoA');
        $linkCopy=$request->input('linkCopy');
        $desc=$request->input('desc');
        $portada=$request->input('portada');
        $overAge=($request->input('ageRestrict')=="on") ? 1 : 0;
        $pId=Auth::user()->id;
        // $id_contingut=DB::table('contingut')->max('id');

        // Validaciones
        $info=TipoContenidoModel::find($typeContent);
        $info->Descripcio=explode(' ',$info->Descripcio);
        $info->Descripcio=implode(',',$info->Descripcio);
        // return $info->espai;

        $request->validate([
            'arxiu'=>"required|mimes:$info->Descripcio|max:$info->espai",
            'derechoA'=>"required",
            'tipoC'=>"required"
        ]);

        $url=public_path('/contenido/'.$typeContent);
        // Mueve las imagenes a su directorio conveniente
        if($request->hasFile('portada')) {
            $portada=time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$request->portada->extension();
            $request->portada->move(public_path('/contenido/1'),$portada);
        }

        if($request->hasFile('arxiu')) {
            $archivo=time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$request->arxiu->extension();
            $archivo=trim($archivo);
            $request->arxiu->move($url,$archivo);

            $subido=ContingutModel::create([
                'propietari'=>$pId,
                'titulo'=>$titulo,
                'drets_autor'=>$rights,
                'tipus_contingut'=>$typeContent,
                'link_copyright'=>$linkCopy,
                'descripcio'=>$desc,
                'majoria_edat'=>$overAge,
                'portada'=>$portada,
                'url'=>$archivo,
                'reportat'=>0
            ]);
            $id_contingut = $subido->id;

            if(!empty($tags)) {

                foreach($tags as $t) {
                    $exists=TagsModel::where('nombre',"=",$t)->get()->first();
                    if(!$exists) {
                        $tag=TagsModel::create([
                            "nombre"=>strtolower($t)
                        ]);
                        $lastTag=$tag;
                        ContingutTagModel::create([
                            "id_contingut"=>$id_contingut,
                            "id_tag"=>$lastTag->id
                        ]);
                    }else {
                        ContingutTagModel::create([
                            "id_contingut"=>$subido->id,
                            "id_tag"=>$exists->id
                        ]);
                    }
                }

            }
                $actius = DB::table('analitiques_generals')->max('id');
                $analitiques = AnalitiquesGeneralsModel::find($actius);
                $aux2 = AnalitiquesGeneralsModel::where('id',$actius)
                ->update([
                    "contenido_total"=>$analitiques->contenido_total+1
                ]);
                return redirect('/');
        }
    }

    public function deleteContenido($idContenido) {
        $contenido =ContingutModel::where('id',$idContenido)
        ->delete();
        $actius = DB::table('analitiques_generals')->max('id');
        $analitiques = AnalitiquesGeneralsModel::find($actius);
        $aux2 = AnalitiquesGeneralsModel::where('id',$actius)
        ->update([
            "contenido_total"=>$analitiques->contenido_total-1
        ]);
        return $contenido;
    }

    public function eliminar() {
        $contenido=ContingutModel::all();
        return view('back.supereliminar')->with('contenido',$contenido);
    }

}
