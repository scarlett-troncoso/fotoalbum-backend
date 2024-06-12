<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(){
        return response()->json([
            'success' => true, 
            'results' => Photo::with(['category', 'user'])->orderByDesc('id')->paginate()
            ]);
        } 

    public function show($id){
        $photo = Photo::with(['category', 'user'])->where('id', $id)->first(); //il primo che trovi, oppure null, dove l'id sia uguale all'id del parametro di questa function
    
        if ($photo) {// se cé il post allora
            return response()->json([ // restituendo un response formattato come un json
                'success' => true,
                'results' => $photo
            ]);
        } else {
            return response()->json([ // restituendo un response formattato come un json
                'success' => false,
                'results' => 'Foto non trovata'
            ]);
        }
    }
}
