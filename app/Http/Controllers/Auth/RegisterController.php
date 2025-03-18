<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\PersonType;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        return view('admin.users.create', compact('document_type', 'person_type'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([

            'first_name' => $data['first_name'],
            'identification' => $data['identification'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Cambia la contraseña según necesites
            'document_type_id' => $data['document_type_id'], // Ajusta según tu BD
            'person_type_id' => $data['person_type_id'], // Ajusta según tu BD
            'professional_card' => $data['professional_card'], // Ajusta según tu BD
            'cellphone' => $data['cellphone'],
            'department' => $data['department'],
            'city' => $data['city'],
            'neighborhood' => $data['neighborhood'],
            'address' => $data['address']

        ]);
        // Asignar el rol de ADMIN
        if (!$user->hasRole('USUARIO')) {
            $user->assignRole('USUARIO');
        }
        event(new Registered($user));
        return $user;
    }

    public function register(Request $request)
    {
        // dd('entro');
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            // dd('error');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Mantiene los valores ingresados
        }

        $this->create($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario registrado correctamente');
    }
}
