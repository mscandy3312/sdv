<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Primero eliminamos la restricción unique si existe
            $table->dropUnique(['code']);
            
            // Luego modificamos la columna para que sea nullable
            $table->string('code')->nullable()->change();
            
            // Finalmente volvemos a agregar la restricción unique
            $table->unique('code');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->string('code')->nullable(false)->change();
            $table->unique('code');
        });
    }
}; 