<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents\Type;

class DocumentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.documents.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documents.types.create');
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

        $hasType = Type::where('name', $data['name'])->get();

        if($hasType->isNotEmpty()) {
          notify()->flash('Tipo não Adicionado!', 'error', [
            'text' => 'Este tipo de documento já existe.'
          ]);
          return redirect()->route('types.index');
        }

        $data['price'] = number_format(str_replace(',', '.', $data['price']), 2);

        Type::create($data);

        notify()->flash('Tipo Adicionado!', 'success', [
          'text' => 'Novo tipo de documento adicionado com sucesso.'
        ]);

        return redirect()->route('types.index');
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
        $type = Type::uuid($id);
        return view('admin.documents.types.edit', compact('type'));
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
        $type = Type::uuid($id);

        $data['price'] = number_format(str_replace(',', '.', $data['price']), 2);
        
        $type->update($data);

        notify()->flash('Tipo Atualizado!', 'success', [
          'text' => 'Tipo de documento atualizado com sucesso.'
        ]);

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
