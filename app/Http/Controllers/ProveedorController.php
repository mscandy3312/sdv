<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Supplier::paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'Legal_Compliance' => 'required|string|max:200',
            'General_Supplier_Profile' => 'required|string|max:200',
            'Price' => 'required|numeric',
            'Technical_Capability' => 'required|string|max:200',
            'Technology_and_Infrastructure' => 'required|string|max:200',
            'Performance_and_Service_Level' => 'required|string|max:200'
        ]);

        $data = $request->all();
        $data['Legal Compliance'] = $data['Legal_Compliance'];
        $data['General Supplier Profile'] = $data['General_Supplier_Profile'];
        $data['Technical Capability'] = $data['Technical_Capability'];
        $data['Technology and Infrastructure'] = $data['Technology_and_Infrastructure'];
        $data['Performance and Service Level'] = $data['Performance_and_Service_Level'];

        unset($data['Legal_Compliance']);
        unset($data['General_Supplier_Profile']);
        unset($data['Technical_Capability']);
        unset($data['Technology_and_Infrastructure']);
        unset($data['Performance_and_Service_Level']);

        Supplier::create($data);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado exitosamente.');
    }

    public function edit(Supplier $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Supplier $proveedor)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'Legal_Compliance' => 'required|string|max:200',
            'General_Supplier_Profile' => 'required|string|max:200',
            'Price' => 'required|numeric',
            'Technical_Capability' => 'required|string|max:200',
            'Technology_and_Infrastructure' => 'required|string|max:200',
            'Performance_and_Service_Level' => 'required|string|max:200'
        ]);

        $data = $request->all();
        $data['Legal Compliance'] = $data['Legal_Compliance'];
        $data['General Supplier Profile'] = $data['General_Supplier_Profile'];
        $data['Technical Capability'] = $data['Technical_Capability'];
        $data['Technology and Infrastructure'] = $data['Technology_and_Infrastructure'];
        $data['Performance and Service Level'] = $data['Performance_and_Service_Level'];

        unset($data['Legal_Compliance']);
        unset($data['General_Supplier_Profile']);
        unset($data['Technical_Capability']);
        unset($data['Technology_and_Infrastructure']);
        unset($data['Performance_and_Service_Level']);

        $proveedor->update($data);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy(Supplier $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado exitosamente.');
    }
} 