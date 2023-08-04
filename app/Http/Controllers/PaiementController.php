<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=DB::select('SELECT totalprixcommande.id as id_user,totalprixcommande.name,totalprixcommande.adresse,
        totalprixcommande.telephonne,totalprixcommande.prixCommande,totalprixpayments.prixPaiement FROM
         totalprixcommande INNER JOIN totalprixpayments ON totalprixcommande.id=totalprixpayments.id ');

        return view("paiements.liste_paiement",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients=User::where("role",1)->get();
        return view("paiements.ajouter_paiement",compact("clients"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=User::find($request->id);
        $request->validate([
            "date_paiement"  =>  "required",
            "prix_paiement"  =>  "required",
            "id"    =>  "required|exists:users,id"
        ]);
        $user->paiements()->create([
            "date_paiement"=>$request->input("date_paiement"),
            "prix_paiement"=>$request->input("prix_paiement"),
            "id"=>$request->input("id")
        ]);
        // return $request;
        return redirect()->route("admin-paiement.index")->with(["success"=>"un paiement à été ajouté"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Paiement::where("id",$id)->delete();
        return redirect()->route("admin-paiement.index")->with(["success"=>"un paiement à été supprimé"]);
    }
}
