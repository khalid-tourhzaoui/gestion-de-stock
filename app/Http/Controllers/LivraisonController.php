<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role=="admin"){
            $data=Livraison::where("etat",0)->get();
        }else{
            $data=Livraison::where("etat",0)->where("id",Auth::user()->id)->get();
        }
        return view("Livraisons.liste_livraison",compact("data"));
        // foreach ($data as $item){
        //     echo $item->user->name."<br>";
        //     echo $item->commande->user->name;
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $livreurs=User::where("role",3)->get();
        $commandes=Commande::where("status",0)->get();
        return view("Livraisons.ajouter_livraison",compact("livreurs","commandes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=User::find($request->input("id"));
        $commande=Commande::find($request->id_commande);
        $request->validate([
            "id"=>"required|exists:users,id",
            "id_commande"=>"required|exists:commandes,id_commande",
            "date_livraison"=>"required|after_or_equal:".date("Y-m-d"),
            "adresse"=>"required|max:150"
        ]);
        $user->livraisons()->create([
            "id"=>$request->input("id"),
            "id_commande"=>$request->input("id_commande"),
            "date_livraison"=>$request->input("date_livraison"),
            "adresse"=>$request->input("adresse"),
            "etat"=>0
        ]);
        $commande->update(["status"=>1]);
        return redirect()->route("admin-livraison.index")->with(["success"=>"Une livraison à été ajoutée"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Livraison::where("etat",1)->get();
        return view("Livraisons.historique_livraison",compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $livraison=Livraison::find($id);
        $livraison->update(["etat"=>1]);
        $livraison->commande()->update(["status"=>3]);
        if(Auth::user()->role=="admin"){
            return redirect()->route("admin-livraison.index")->with(['success'=>"une livraison à été ajoutée a l'historique"]);
        }else{
            return redirect()->route("livreur-livraison.index")->with(['success'=>"une livraison à été ajoutée a l'historique"]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Livraison::find($id);
        $data->delete();
        return redirect()->route("admin-livraison.show","historique")->with(["success"=>"Une livraison à été supprimée"]);
    }
}
