<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::where('restaurant_id', Auth::id())->paginate(3);

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'photo' => ['required', 'image'],
        ], [
            'name.required' => 'Il campo nome è obbligatorio',
            'name.string' => 'Il campo nome deve essere una stringa',
            'description.required' => 'Il campo descrizione è obbligatorio',
            'description.string' => 'Il campo descrizione deve essere una stringa',
            'price.required' => 'Il campo prezzo è obbligatorio',
            'price.numeric' => 'Il campo prezzo deve essere un numero',
            'price.between' => 'Il campo prezzo deve essere compreso tra :min e :max',
            'photo.required' => 'Il campo foto è obbligatorio',
            'photo.image' => 'Il file caricato deve essere un immagine',
        ]);


        if (!$request->has('is_visible')) $data['is_visible'] = 0;
        $data['restaurant_id'] = Auth::id();

        //* Metodo caricamento immagine 
        if (Arr::exists($data, 'photo')) {

            $img_path = Storage::put('uploads/dishes', $data['photo']);
            $data['photo'] =  $img_path;
        }

        $dish = new Dish;
        $dish->fill($data);
        $dish->save();

        return to_route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        if ($dish->restaurant->id != Auth::id()) abort(403);

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        if ($dish->restaurant->id != Auth::id()) abort(403);

        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'photo' => ['required', 'image'],
        ], [
            'name.required' => 'Il campo nome è obbligatorio',
            'name.string' => 'Il campo nome deve essere una stringa',
            'description.required' => 'Il campo descrizione è obbligatorio',
            'description.string' => 'Il campo descrizione deve essere una stringa',
            'price.required' => 'Il campo prezzo è obbligatorio',
            'price.numeric' => 'Il campo prezzo deve essere un numero',
            'price.between' => 'Il campo prezzo deve essere compreso tra :min e :max',
            'photo.required' => 'Il campo foto è obbligatorio',
            'photo.image' => 'Il file caricato deve essere un immagine',
        ]);

        if (!$request->has('is_visible')) $data['is_visible'] = 0;
        $data['restaurant_id'] = Auth::id();

        //* Metodo caricamento immagine 

        if (Arr::exists($data, 'photo')) {
            if ($dish->photo) Storage::delete($dish->photo);
            $img_path = Storage::put('uploads/dishes', $data['photo']);
            $data['photo'] =  $img_path;
        }

        $dish->fill($data);
        $dish->update();

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }
}