<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'empresa_nombre' => 'required|string|max:255',
            'empresa_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'empresa_direccion' => 'nullable|string|max:255',
            'empresa_telefono' => 'nullable|string|max:20',
            'empresa_email' => 'nullable|email|max:255',
            'moneda_simbolo' => 'required|string|max:5',
            'impuesto_porcentaje' => 'required|numeric|min:0|max:100',
            'factura_pie_pagina' => 'nullable|string',
            'ticket_pie_pagina' => 'nullable|string'
        ]);

        $settings = SystemSetting::first() ?? new SystemSetting();
        
        if ($request->hasFile('empresa_logo')) {
            if ($settings->empresa_logo) {
                Storage::delete('public/' . $settings->empresa_logo);
            }
            $path = $request->file('empresa_logo')->store('logos', 'public');
            $settings->empresa_logo = $path;
        }

        $settings->fill($request->except('empresa_logo'));
        $settings->save();

        return redirect()->route('settings.index')
            ->with('success', 'Configuración actualizada exitosamente');
    }
} 