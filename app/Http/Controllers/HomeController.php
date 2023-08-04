<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
     public function index(){
        if (Auth::id()){
            if (Auth::user()->role == "admin"){
                return redirect()->route("admin.index");
            }elseif(Auth::user()->role=="client"){
                return redirect()->route("client.index");
            }elseif(Auth::user()->role=="fournisseur"){
                return redirect()->route("fournisseur.index");
            }elseif(Auth::user()->role=="livreur"){
                return redirect()->route("livreur.index");
            }
        }
    }
}
