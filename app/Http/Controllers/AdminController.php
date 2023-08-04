<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.dashbord");
    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function create(Request $request)
    {
    return view("Utilistauers.ajouter_utilisateur");
    }
    /**---------------------------------- */
    public function getUtilistauer(Request $request){
        $typeUser=$request->typeUser;
        $data=User::where("role",$typeUser)->get();
        return view("Utilistauers.liste_utilisateurs",compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required|unique:users,email",
            "adresse"=>"required",
            "cin"=>"required|unique:users,cin",
            "telephonne"=>"required|max:13|min:13",
            "role"=>"required",
            "mot_passe"=>"required|min:8|max:13"
        ]);
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "adresse"=>$request->adresse,
            "cin"=>$request->cin,
            "telephonne"=>$request->telephonne,
            "role"=>$request->role,
            "password"=>bcrypt($request->mot_passe)
        ]);
        return redirect()->route("admin-utilisateurs")->with(["success"=>"un utilisateur a été ajouté"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=User::find($id);
        return view("Utilistauers.details_utilisateur",compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=User::find($id);
        return view("Utilistauers.modifier_utilisateur",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        if($request->old_cin==$request->cin){
            $request->validate([
                "name"=>"required",
                "email"=>"required",
                "adresse"=>"required",
                "cin"=>"required",
                "telephonne"=>"required|max:13|min:13",
                "role"=>"required",
                // "mot_passe"=>"required|min:8|max:13"
            ]);
            $user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "adresse"=>$request->adresse,
                "cin"=>$request->cin,
                "telephonne"=>$request->telephonne,
                "role"=>intval($request->input("role"))
                // "password"=>bcrypt($request->mot_passe)
            ]);
        }elseif($request->old_email===$request->old_cin){

        }else{
            $request->validate([
                "name"=>"required",
                "email"=>"required|unique:users,email",
                "adresse"=>"required",
                "cin"=>"required|unique:users,cin",
                "telephonne"=>"required|max:13|min:13",
                "role"=>"required",
                // "mot_passe"=>"required|min:8|max:13"
            ]);
            $user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "adresse"=>$request->adresse,
                "cin"=>$request->cin,
                "telephonne"=>$request->telephonne,
                "role"=>intval($request->input("role"))
                // "password"=>bcrypt($request->mot_passe)
            ]);
        }
        return redirect()->route("admin-utilisateurs")->with(["success"=>"un utilisateur a été modifié"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route("admin.create")->with(["success"=>"un utilisateur a été supprimé"]);
    }
}
