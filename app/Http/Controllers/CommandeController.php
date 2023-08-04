<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role=="admin"){
            $data = DB::table('commandes')
            ->select('commandes.id_commande','commandes.status','users.id','name', 'users.adresse', 'telephonne', 'quantite_commande', 'prix_commande', 'date_commande')
            ->join('users', 'commandes.id', '=', 'users.id')->where("status",'=',0)->orWhere("status","=",1)
            ->get();


        }else{
            $data=Commande::where("id",Auth::user()->id)->where("status",'<>',3)->get();
        }
        return view("Commandes.liste_commandes",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Commandes.ajouter_commande");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["quantite_commande"=>"required"]);
        Commande::create([
            "id"=>Auth::user()->id,
            "quantite_commande"=>$request->input("quantite_commande"),
            "prix_commande"=>floatval($request->input("quantite_commande")*2),
            "date_commande"=>date("Y-m-d")
        ]);
        return redirect()->route("commande.index")->with(["success"=>"une commande a été ajoutée"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::user()->role==="admin"){
            $data=Commande::where("status",3)->get();
        }else{
            $id=Auth::user()->id;
            $data=DB::table("users")->join("commandes","commandes.id","=","users.id")->join("livraisons","commandes.id_commande","=","livraisons.id_commande")
            ->where("commandes.status","=",3)->where("commandes.id","=",$id)->select("commandes.*","livraisons.*","users.*")->get();
        }
        return view("Commandes.historique_commande",compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Commande::find($id);
        return view("Commandes.modifier_commande",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $commande=Commande::find($id);
        $request->validate(["quantite_commande"=>"required"]);
        $commande->update([
            "id"=>Auth::user()->id,
            "quantite_commande"=>$request->input("quantite_commande"),
            "prix_commande"=>floatval($request->input("quantite_commande")*2),
            "date_commande"=>date("Y-m-d")
        ]);
        return redirect()->route("commande.index")->with(["success"=>"une commande a été modifiée"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commande=Commande::find($id);
        $commande->delete();
        if(Auth::user()->role=="admin"){
            return redirect()->route("admin-commande.show","historique")->with(["success"=>"une commande a été supprimée"]);
        }else{
            return redirect()->route("commande.index")->with(["success"=>"une commande a été supprimée"]);
        }
    }
}
