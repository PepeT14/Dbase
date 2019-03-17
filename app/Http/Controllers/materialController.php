<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class materialController extends Controller
{
    //
    public function createMaterial(Request $request){
        $admin = Auth::guard('admin')->user();
        $material = New ClubMaterial();
        $material->cantidad = $request->input('cantidad');
        $material->stock = $request->input('cantidad');
        $material->type= $request->input('type');
        $material->subtype = $request->input('subtype');
        $material->description = $request->input('description');
        $material->club_id = $admin->club->id;
        $material->save();

        return redirect()->action('adminController@material');
    }

    public function deleteMaterial($id){
        ClubMaterial::where('id',$id)->first()->delete();
        return $this->material();
    }
    public function addMaterial($id){
        $material=ClubMaterial::where('id',$id)->first();
        $material->cantidad = $material->cantidad+1;
        $material->stock = $material->stock+1;
        $material->save();
        return $this->material();
    }

}
