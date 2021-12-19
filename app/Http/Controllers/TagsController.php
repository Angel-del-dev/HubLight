<?php

namespace App\Http\Controllers;

use App\Models\ContingutModel;
use App\Models\ContingutTagModel;
use App\Models\TagsModel;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function getAll() {
        $tags = TagsModel::all();
        return $tags;
    }

    public function getTags() {
        $tags = TagsModel::orderBy("id","desc")->get();
        return view('back.tags')->with('tags',$tags);
    }

    public function deleteTag(Request $request) {

        $tags =TagsModel::where("id",$request->input("id"))->delete();

        return 1;
    }

    public function storeTag(Request $request) {
        $newTag=TagsModel::create([
            'nombre'=>$request->input('nombre')
        ]);
        return redirect('/back/admin/tags');
    }

    public function getByIdView($idTag) {
        $tags=TagsModel::where('id',$idTag)->get()->first();
        // return $tags;
        if(!isset($tags->nombre)) return redirect('/notfound');
        return view('front.etiqueta')->with('idTag',$idTag);
    }

    public function getById($idTag,$offset) {
        $take=30;
        $contentTags=ContingutModel::where('contingut_tag.id_tag',$idTag)
        ->join("contingut_tag","contingut_tag.id_contingut","=","contingut.id")
        ->take($take)
        ->skip($take*$offset)
        ->get();
        return $contentTags;
    }
}
