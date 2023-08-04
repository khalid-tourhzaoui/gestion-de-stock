<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role=="admin"){
            $data=Reclamation::all();
        }else{
        $data=Reclamation::where("id",Auth::user()->id)->get();
        }
        return view("Reclamations.liste_reclamation",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Reclamations.ajouter_reclamation");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "message"=>"required",
            "date_reclamation"=>"required"
        ]);
        Reclamation::create([
            "message"=>$request->input("message"),
            "date_reclamation"=>$request->input("date_reclamation"),
            "id"=>Auth::user()->id
        ]);
        return redirect()->route("reclamation.index")->with(["success"=>"une réclamation a été ajouté"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Reclamation::find($id);
        return view("Reclamations.details_reclamation",compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Reclamation::find($id);
        return view("Reclamations.modifier_reclamation",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $reclamation=Reclamation::find($id);
        $request->validate([
            "message"=>"required",
            "date_reclamation"=>"required"
        ]);
        $reclamation->update([
            "message"=>$request->input("message"),
            "date_reclamation"=>$request->input("date_reclamation"),
            "id"=>Auth::user()->id
        ]);
        return redirect()->route("reclamation.index")->with(["success"=>"une réclamation a été modifié"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reclamation=Reclamation::find($id);
        $reclamation->delete();
        return redirect()->route("reclamation.index")->with(["success"=>"une réclamation a été supprimé"]);

    }
}
