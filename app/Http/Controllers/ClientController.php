<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientUser;
use App\Models\DocumentType;
use App\Models\PersonType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        $clients = Client::select('client_users.id as client_user_id', 'clients.*')  // <-
            ->join('client_users', 'clients.id', '=', 'client_users.client_id')
            ->where('client_users.user_id', Auth::id())->paginate(5);
        return view('clients.index', compact('clients', 'document_type', 'person_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $document_type = DocumentType::all();
        $person_type = PersonType::all();
        return view('clients.create', compact('document_type', 'person_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'document_type_id' => 'required|exists:document_types,id',
                'person_type_id'   => 'required|exists:person_types,id',
                'identification'   => 'required|string|max:20|unique:clients,identification',
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255|unique:clients,email',
                'headquarters'             => 'required|string|max:255',
                'representative'             => 'required|string|max:255',

            ]
        );

        if ($validator->fails()) {
            // dd('error');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Mantiene los valores ingresados
        }

        $validatedData = $validator->validated();

        $client = Client::firstOrcreate([
            'identification' => $validatedData['identification'],
        ], [
            'document_type_id' => $validatedData['document_type_id'],
            'person_type_id' => $validatedData['person_type_id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        ClientUser::create([
            'user_id' => Auth::id(),
            'client_id' => $client->id,
            'headquarters' => $validatedData['headquarters'],
            'representative' => $validatedData['representative'],
        ]);

        return redirect()->route('client.index')->with('success', 'Cliente registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function clientUserData($user_client_id)
    {
        $client_user = ClientUser::join('clients', 'client_users.client_id', '=', 'clients.id')
            ->join('document_types', 'clients.document_type_id', '=', 'document_types.id')
            ->join('person_types', 'clients.person_type_id', '=', 'person_types.id')
            ->select('client_users.id as client_user_id', 'client_users.*', 'clients.id as client_id', 'clients.*', 'document_types.name as document_type', 'person_types.name as person_type')
            ->where('client_users.id', $user_client_id)->get();


        return response()->json($client_user, 200);
    }

    public function clientUserUpdate(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'document_type_id' => 'required|exists:document_types,id',
                'person_type_id'   => 'required|exists:person_types,id',
                'identification'   => 'required|string|max:20|unique:clients,identification,' . $request->client_id,
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255|unique:clients,email,' . $request->client_id,
                'headquarters'     => 'required|string|max:255',
                'representative'   => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 200);
        }

        $validatedData = $validator->validated();
        $user_client = ClientUser::find($id);
        $user_client->update([
            'headquarters' => $validatedData['headquarters'],
            'representative' => $validatedData['representative'],
        ]);

        $client = Client::find($user_client->client_id);
        $client->update([
            'document_type_id' => $validatedData['document_type_id'],
            'person_type_id' => $validatedData['person_type_id'],
            'identification' => $validatedData['identification'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return  response()->json(['status' => true, 'message' => 'Se ha actualizado el cliente '], 200);
    }

    public function clientUserDelete($userClientId)
    {
        $clientUser = ClientUser::findOrFail($userClientId);

        if (!$clientUser) {
            return redirect()->back()->with('error', "La relación no existe.");
        }

        $clientUser->delete();

        return redirect()->route('users.index')->with('success', "El Cliente ha sido eliminado exitosamente.");
    }
}
