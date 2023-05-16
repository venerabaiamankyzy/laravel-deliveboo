<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Arr;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();

        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vat_number' => ['required', 'numeric', 'min_digits:11', 'max_digits:11', 'unique:' . Restaurant::class . ',vat_number'],
            'phone_number' => ['required', 'numeric', 'min_digits:7', 'max_digits:11'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image'],
            'types' => ['required'],
        ], [
            'name.required' => 'Il campo Nome è obbligatorio',
            'name.max' => 'Il campo Nome deve avere al massimo :max caratteri',
            'email.required' => 'Il campo E-mail è obbligatorio',
            'email.email' => 'Il campo E-mail deve contenere un indirizzo e-mail valido',
            'email.max' => 'Il campo E-mail deve avere al massimo :max caratteri',
            'email.unique' => 'L\'E-mail inserita è già presente',
            'password.required' => 'Il campo Password è obbligatorio',
            'password.confirmed' => 'Le due password non corrispondono',
            'company_name.required' => 'Il campo Nome dell\'azienda è obbligatorio',
            'company_name.max' => 'Il campo Nome dell\'azienda deve avere al massimo :max caratteri',
            'address.required' => 'Il campo Indirizzo è obbligatorio',
            'address.max' => 'Il campo Indirizzo deve avere al massimo :max caratteri',
            'vat_number.required' => 'Il campo Partita IVA è obbligatorio',
            'vat_number.numeric' => 'Il campo Partita IVA deve essere un numero',
            'vat_number.min_digits' => 'Il campo Partita IVA deve essere di :min caratteri',
            'vat_number.max_digits' => 'Il campo Partita IVA deve essere di :max caratteri',
            'vat_number.unique' => 'La Partita IVA inserita è già presente',
            'phone_number.required' => 'Il campo Telefono è obbligatorio',
            'phone_number.numeric' => 'Il campo Telefono deve essere un numero',
            'phone_number.max_digits' => 'Il campo Telefono deve avere al massimo :max caratteri',
            'phone_number.min_digits' => 'Il campo Telefono deve avere minimo :min caratteri',
            'types.required' => 'Il campo Tipologia è obbligatorio',
            'photo.image' => 'Il file caricato deve essere un immagine',


        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $restaurant = Restaurant::create([
            'user_id' => $user->id,
            'name' => $request->company_name,
            'address' => $request->address,
            'vat_number' => $request->vat_number,
            'phone_number' => $request->phone_number,
            'description' => $request->description,
            'photo' => $request->photo,
        ]);

        if (Arr::exists($data, "types")) $restaurant->types()->attach($data["types"]);

        //* Metodo caricamento immagine 
        if (Arr::exists($data, 'photo')) {

            $img_path = Storage::put('uploads/restaurants', $data['photo']);
            $data['photo'] =  $img_path;
        }

        event(new Registered($user));

        Auth::login($user);

        // dd($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
