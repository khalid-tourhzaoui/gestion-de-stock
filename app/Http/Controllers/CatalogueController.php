<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role=="admin"){
            $data=Catalogue::all();
        }else{
            $data=Catalogue::where("id",Auth::user()->id)->get();
        }
        return view("Catalogues.liste_catalogues",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Catalogues.ajouter_catalogues");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');
        Catalogue::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "image"=>$imagePath,
            "id"=>Auth::user()->id
        ]);
        return redirect()->route("catalogue.index")->with(["success"=>"un catalogue a été ajouté"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Catalogue::find($id);
        return view("Catalogues.details_catalogue",compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Catalogue::find($id);
        return view("Catalogues.modifier_catalogue",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $catalogue =Catalogue::find($id);


        $updateData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $catalogue->image;

            Storage::disk('public')->delete($imagePath);

            $newImagePath = $request->file('image')->store('uploads', 'public');
            $updateData['image'] = $newImagePath;
        }

        $catalogue->update($updateData);

        return redirect()->route('catalogue.index')->with(['success' => 'Catalogue updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $catalogue =Catalogue::find($id);
        $imagePath = $catalogue->image;
        Storage::disk('public')->delete($imagePath);
        $catalogue->delete();
        return redirect()->route("catalogue.index")->with(["success"=>"un catalogue a été supprimé"]);
    }
}
