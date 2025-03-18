<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query()->with('categoria');

        // Filtrar por categoría
        if ($request->has('categoria')) {
            $query->where('category_id', $request->categoria);
        }

        // Filtrar por stock
        if ($request->has('stock')) {
            switch ($request->stock) {
                case 'bajo':
                    $query->where('stock', '<=', 10);
                    break;
                case 'normal':
                    $query->whereBetween('stock', [11, 50]);
                    break;
                case 'alto':
                    $query->where('stock', '>', 50);
                    break;
            }
        }

        // Búsqueda por nombre o código
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%");
            });
        }

        $productos = $query->latest()->paginate(10)->withQueryString();
        $categorias = Categoria::select('id', 'name')->get();
        
        return view('productos.index', compact('productos', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categories,id',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'codigo' => 'required|string|unique:products,code'
        ]);

        $data = [
            'name' => $request->nombre,
            'code' => $request->codigo,
            'price' => $request->precio,
            'stock' => $request->stock,
            'category_id' => $request->categoria_id,
            'description' => $request->descripcion
        ];

        if ($request->hasFile('imagen')) {
            $data['image'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categories,id',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->nombre,
            'price' => $request->precio,
            'stock' => $request->stock,
            'category_id' => $request->categoria_id,
            'description' => $request->descripcion
        ];

        if ($request->hasFile('imagen')) {
            if ($producto->image) {
                Storage::disk('public')->delete($producto->image);
            }
            $data['image'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Producto $producto)
    {
        try {
            DB::beginTransaction();

            if ($producto->image) {
                Storage::disk('public')->delete($producto->image);
            }

            $producto->delete();
            DB::commit();

            return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('productos.index')
                ->with('error', 'No se puede eliminar el producto porque está siendo utilizado');
        }
    }

    public function buscar(Request $request)
    {
        $query = $request->get('q');
        $productos = Producto::where('nombre', 'like', "%{$query}%")
                            ->orWhere('codigo', 'like', "%{$query}%")
                            ->where('estado', true)
                            ->where('stock', '>', 0)
                            ->take(5)
                            ->get();
        
        return response()->json($productos);
    }

    public function exportar($formato)
    {
        try {
            $productos = Producto::with('categoria')->get();
            
            if ($formato === 'pdf') {
                $dompdf = new Dompdf();
                $html = view('exports.productos', compact('productos'))->render();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                return $dompdf->stream('productos.pdf');
            }
            
            if ($formato === 'excel') {
                return Excel::download(new ProductosExport($productos), 'productos.xlsx');
            }
            
            return back()->with('error', 'Formato no soportado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al exportar: ' . $e->getMessage());
        }
    }
}
