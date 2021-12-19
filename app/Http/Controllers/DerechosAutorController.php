<?php

namespace App\Http\Controllers;

use App\Models\DerechosAutorModel;
use Illuminate\Http\Request;

class DerechosAutorController extends Controller
{
    public function getAll() {
        $derechos = DerechosAutorModel::all();
        return $derechos;
    }

    public function getRights() {
        $rights = DerechosAutorModel::all();
        return view('back.rights')->with('rights',$rights);
    }

    public function store(Request $request) {
        // return $request
        $rights=DerechosAutorModel::create([
            "tipus"=>$request->input('tipus')
        ]);
        return redirect('/back/admin/rights');
    }

    public function deleteRight(Request $request) {
        $tipus =DerechosAutorModel::where('id_dret',$request->input('id'))
        ->delete();
        return true;
    }

    public function edit(Request $request) {
        $edit=DerechosAutorModel::where('id_dret',$request->input('id'))
        ->update([
            "tipus"=>$request->input('value')
        ]);
        return 1;
    }
}
