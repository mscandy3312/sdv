<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::withCount('productos')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable'
        ]);

        Categoria::create([
            'name' => $request->nombre,
            'description' => $request->descripcion
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        $categoria->load('productos');
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable'
        ]);

        $categoria->update([
            'name' => $request->nombre,
            'description' => $request->descripcion
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        try {
            DB::beginTransaction();

            if ($categoria->productos()->exists()) {
                $categoriaPorDefecto = Categoria::firstOrCreate(
                    ['name' => 'Sin categoría'],
                    ['description' => 'Productos sin categoría asignada']
                );

                if ($categoria->id === $categoriaPorDefecto->id) {
                    throw new \Exception('No se puede eliminar la categoría por defecto');
                }

                $categoria->productos()->update(['category_id' => $categoriaPorDefecto->id]);
            }

            $categoria->delete();
            DB::commit();

            return redirect()->route('categorias.index')
                ->with('success', 'Categoría eliminada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('categorias.index')
                ->with('error', $e->getMessage() ?? 'No se pudo eliminar la categoría');
        }
    }
}
