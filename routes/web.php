<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Opcional: rutas de registro si quieres permitir que los usuarios se registren
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Redirigir directamente al login
Route::redirect('/', '/login');

// Proteger todas las rutas con autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard como ruta principal después del login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas de Ventas
    Route::get('ventas/productos/buscar', [VentaController::class, 'buscarProducto'])
        ->name('ventas.buscar-producto');
    Route::resource('ventas', VentaController::class);
    Route::get('ventas/exportar/{formato}', [VentaController::class, 'exportar'])->name('ventas.exportar');

    // Rutas de Productos
    Route::resource('productos', ProductoController::class);
    Route::get('productos/exportar/{formato}', [ProductoController::class, 'exportar'])->name('productos.exportar');

    // Rutas de Categorías
    Route::resource('categorias', CategoriaController::class);
    Route::get('categorias/exportar/{formato}', [CategoriaController::class, 'exportar'])->name('categorias.exportar');

    // Rutas de Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes/exportar/{formato}', [ClienteController::class, 'exportar'])->name('clientes.exportar');

    // Rutas para reportes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
        Route::get('/products', [ReportController::class, 'products'])->name('products');
        Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
    });

    // Rutas para configuración
    Route::get('/configuracion', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/configuracion', [SettingController::class, 'update'])->name('settings.update');

    // Dentro del grupo de rutas con middleware auth
    Route::get('/ventas/{venta}/pdf', [VentaController::class, 'generarPDF'])->name('ventas.pdf');

    // Rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rutas para mostrar detalles del producto
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

    // Rutas para promociones
    Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones.index');

    // Rutas para la tienda
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/shop/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('shop.addToCart');
    Route::get('/shop/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::patch('/shop/update-cart', [ShopController::class, 'updateCart'])->name('shop.updateCart');
    Route::delete('/shop/remove-from-cart', [ShopController::class, 'removeFromCart'])->name('shop.removeFromCart');
    Route::get('/shop/clear-cart', [ShopController::class, 'clearCart'])->name('shop.clearCart');

    // Rutas para clientes y proveedores (solo admin)
    Route::resource('proveedores', ProveedorController::class);

    // Rutas para categorías y productos
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'clients' => ClientController::class,
        'suppliers' => SupplierController::class,
        'sales' => SaleController::class,
    ]);
});

require __DIR__.'/auth.php';
