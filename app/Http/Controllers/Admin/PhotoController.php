<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //dd(Photo::orderByDesc('id')->paginate());
       return view('admin.photos.index', ['photos' => Photo::where('user_id', auth()->id())->orderByDesc('id')->paginate()]); // auth() acceso all'utente attualmente registrato
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        // dd($request->all());
        $val_data = $request->validated();
        //dd($val_data);
        $val_data['slug'] = Str::slug($request->title, '-');
        $image_path = Storage::put('uploads', $request->upload_image);
        $val_data['upload_image'] = $image_path;
        // dd($val_data);

        // authenticazione dell utente
        $val_data['user_id'] = auth()->id(); // validation, il campo user_id é uguale all id dell utente registrato

        Photo::create($val_data);
        return to_route('admin.photos.index')->with('message', 'Foto aggiunta con successo !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //dd($photo);
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        // authenticazione dell utente
        if(auth()->id() != $photo->user_id){ // Se l'id del utente registrato non é uguale all user_id di quell post
            abort(403, 'Questo account non coincide con il tuo'); // allora errore
        }
        
        $categories = Category::all();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        // authenticazione dell utente
        if(auth()->id() != $photo->user_id){ // Se l'id del utente registrato non é uguale all user_id di quell post
            abort(403, 'Questo account non coincide con il tuo'); // allora errore
        }  

        // dd($request->all());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug('title', '-');

        if ($request->has('upload_image')) { // if 1:  se cé una upload_image nell mio aggiornamento($request)
            
                if ($photo->upload_image) { // if 2: controllare se gia cera una upload_image 
                    
                    Storage::delete($photo->upload_image); //if 2: allora cancellare
                } 
            
                $image_path = Storage::put('uploads', $request->upload_image); // if 1 :  allora recuperare l'immagine e salvarla nel DB
                $val_data['upload_image'] = $image_path;   
        }

       $photo->update($val_data);

       return to_route('admin.photos.index')->with('message', 'Foto aggiornata con successo !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        // authenticazione dell utente
        if(auth()->id() != $photo->user_id){
            abort(403, 'Questo account non coincide con il tuo'); 
        }

        if ($photo->upload_image) { // questo if lo abbiamo portato da update
            // if so, delete it
            Storage::delete($photo->upload_image);
        }
        
        $photo->delete();

        return to_route('admin.photos.index')->with('message', 'Foto cancellata con successo !');
    }
}
