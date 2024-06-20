<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(Request $request){
        
        if ($request->has('search')) { // se la richiesta ha un search
            return response()->json([ 
                //'search' => $request->search 
                'success' => true, // key, in questo caso non é indispensabile nella prossima route invece si
                'results' => Photo::with(['category', 'user'])->orderByDesc('id')->where('title', 'LIKE', '%' . $request->search . '%')->paginate() // $request->search sarebbe la parola inserita nell search alla stessa volta sarebbe la key nell'api 'search': 'parola'
            ]);
        }

        if ($request->has('filter')) {
                if ($request->filter == 'senza') {
                    return response()->json([ //Filtro per la ricerca delle photo senza categoria
                        'success' => true,
                        'results' => Photo::with(['category', 'user'])->orderByDesc('id')->whereNull('category_id')->paginate()
                    ]);
                } elseif ($request->filter == 'all') {
                    return response()->json([
                        'success' => true,
                        'results' => Photo::with(['category', 'user'])->orderByDesc('id')->whereNotNull('category_id')->paginate()
                    ]);
                } else {
                    return response()->json([
                        //'filter' => $request->filter,
                        'success' => true,
                        'results' => Photo::with(['category', 'user'])->orderByDesc('id')->where('category_id', $request->filter)->paginate() 
                        //'results' => Photo::with(['category', 'user'])->orderByDesc('id')->where('LIMIT' . 'in_evidenza = true' . '<=' '10', $request->filter)->paginate()
                    ]);
                } 
        }

        /*if ($request->has('in_evidence')) {
            return response()->json([
                'success' => true, 
                'results' => Photo::with(['category', 'user'])->where('in_evidence', 1)->get()//with(['category', 'user'])
            ]);
        }*/

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
