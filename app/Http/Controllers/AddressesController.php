<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Client\Address;
use Auth;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!Auth::user()->hasPermission('create.cliente.enderecos')) {
            return abort(403, 'Unauthorized action.');
        }

        $client = Client::uuid($id);
        return view('admin.clients.addresses.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();
        $user = $request->user();

        $client = Client::uuid($data['client_id']);
        $data['client_id'] = $client->id;
        $data['user_id'] = $user->id;
        $data['is_default'] = $request->has('is_default');

        Address::create($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'O Endereço do Cliente foi adicionado com sucesso.'
        ]);

        return redirect()->route('clients.show', $client->uuid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('view.cliente.enderecos')) {
            return abort(403, 'Unauthorized action.');
        }

        $client = Client::uuid($id);
        return view('admin.clients.addresses.index', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $address)
    {
        $address = Address::uuid($address);
        $client = $address->client;
        return view('admin.clients.addresses.edit', compact('client', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $address)
    {
        $data = $request->request->all();

        $address = Address::uuid($address);

        $data['is_default'] = $request->has('is_default');

        $address->update($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'O Endereço do Cliente foi atualizado com sucesso.'
        ]);

        return redirect()->route('clients.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

          $address = Address::uuid($id);
          $address->delete();

          return response()->json([
            'success' => true,
            'message' => 'Endereço removido com sucesso.'
          ]);

        } catch(\Exception $e) {
          return response()->json([
            'success' => false,
            'message' => $e->getMessage()
          ]);
        }
    }
}
