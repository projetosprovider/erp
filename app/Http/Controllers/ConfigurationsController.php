<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Storage;
use App\Models\Configuration;
use App\Models\Configuration\Type;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Configuration::all();
        return view('admin.configurations.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::where('active', true)->get();
        return view('admin.configurations.create', compact('types'));
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

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:configs',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if($data['type_id'] == 2) {
              $data['value'] = !empty($data['value']) ? (boolean)$data['value'] : false;
        } elseif($data['type_id'] == 3) {
            if ($request->hasFile('value') && $request->file('value')->isValid()) {
                $data['value'] = $request->value->store('configs');
            }
        }

        $data['active'] = !empty($data['active']) ? (boolean)$data['active'] : false;
        $data['slug'] = str_slug($data['name']);
        $config = Config::create($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'A Configuração foi adicionada com sucesso.'
        ]);

        return redirect()->route('configurations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = Configuration::findOrFail($id);
        $types = Type::where('active', true)->get();
        return view('admin.configurations.edit', compact('config', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $config = Configuration::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:configurations,name,'.$config->id,
        ]);
        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }
        if($config->type_id == 2) {
              $data['value'] = !empty($data['value']) ? (boolean)$data['value'] : false;
        } elseif($config->type_id == 3) {
            if(Storage::exists($config->value)) {
                Storage::delete($config->value);
            }
            if ($request->hasFile('value') && $request->file('value')->isValid()) {
                $data['value'] = $request->value->store('configs');
            }
        }
        $data['active'] = !empty($data['active']) ? (boolean)$data['active'] : false;
        $config->update($data);

        session()->forget($config->slug);
        session()->forget($config->slug.'data');

        notify()->flash('Sucesso!', 'success', [
          'text' => 'A Configuração foi atualizada com sucesso.'
        ]);

        return redirect()->route('configurations.index');
    }
}
