<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Documents,Client};
use App\Models\Client\Address;
use App\Models\Documents\Type;
use Auth;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('view.documentos')) {
            return abort(403, 'Unauthorized action.');
        }

        $documents = Documents::orderByDesc('id')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $types = Type::all();
        return view('admin.documents.create',compact('clients', 'types'));
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

        $data['created_by'] = $user->id;

        $data['status_id'] = 1;

        $client = Client::uuid($data['client_id']);
        $address = Address::uuid($data['address_id']);
        $type = Type::uuid($data['type_id']);

        $data['client_id'] = $client->id;
        $data['address_id'] = $address->id;
        $data['type_id'] = $type->id;
        $data['price'] = $type->price;

        $document = Documents::create($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Novo Documento adicionado com sucesso.'
        ]);

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Documents::uuid($id);
        $clients = Client::all();
        $types = Type::all();
        return view('admin.documents.edit',compact('clients', 'document', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $document = Documents::uuid($id);

        $client = Client::uuid($data['client_id']);
        $address = Address::uuid($data['address_id']);
        $type = Type::uuid($data['type_id']);

        $data['client_id'] = $client->id;
        $data['address_id'] = $address->id;
        $data['type_id'] = $type->id;

        $document->update($data);

        notify()->flash('Sucesso!', 'success',[
          'text' => 'Documento editado com sucesso.'
        ]);

        return redirect()->route('documents.index');
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

          $document = Documents::uuid($id);
          $document->delete();

          return response()->json([
            'success' => true,
            'message' => 'Documento removido com sucesso.'
          ]);

        } catch(\Exception $e) {
          return response()->json([
            'success' => false,
            'message' => $e->getMessage()
          ]);
        }
    }
}
