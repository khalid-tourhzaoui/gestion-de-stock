<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        $credits=DB::select("SELECT totalprixcommande.prixCommande,totalprixpayments.prixPaiement FROM
         totalprixcommande INNER JOIN totalprixpayments ON totalprixcommande.id=totalprixpayments.id where totalprixcommande.id='{$id}'");
        return view("dashboard.dashbord",compact("credits"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
