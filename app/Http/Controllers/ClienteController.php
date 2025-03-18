<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Client::with(['ventas' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'address' => 'required|string|max:50',
            'comments' => 'nullable|string|max:200',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:50|unique:clients'
        ]);

        $data = $request->all();
        $data['last name'] = $data['last_name'];
        unset($data['last_name']);

        Client::create($data);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Client $cliente)
    {
        $cliente->load('ventas');
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $cliente)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'address' => 'required|string|max:50',
            'comments' => 'nullable|string|max:200',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:50|unique:clients,email,' . $cliente->id
        ]);

        $data = $request->all();
        $data['last name'] = $data['last_name'];
        unset($data['last_name']);

        $cliente->update($data);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
