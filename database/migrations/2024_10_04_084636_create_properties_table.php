<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            //Es el codigo interno de la Inmobiliaria
            $table->integer('inner_id')->unique();
            $table->string('name'); //Nombre de la propiedad Palabra Inmueble-inner_id
            $table->string('slug')->unique(); //inmueble-inner_id
            $table->text('description');
            $table->string('address');
            $table->string('neighborhood');
            $table->bigInteger('price')->nullable();
            $table->bigInteger('cannon_price')->nullable();
            $table->integer('admin_price')->nullable();
            $table->integer('area_building')->nullable();
            $table->integer('area_land')->nullable();
            $table->integer('area_total')->nullable();

            //Caracteristicas

            $table->unsignedTinyInteger('parking')->nullable();
            $table->unsignedTinyInteger('air_conditioning')->nullable();
            $table->unsignedTinyInteger('bedroom_with_bathroom')->nullable();
            $table->unsignedTinyInteger('bedroom_without_bathroom')->nullable();
            $table->unsignedTinyInteger('bedroom_total')->nullable();
            $table->unsignedTinyInteger('bathroom_total')->nullable();
            $table->unsignedTinyInteger('half_bathroom')->nullable(); //Rango: 0 a 255
            $table->unsignedSmallInteger('year_built')->nullable(); //0 a 65,535
            $table->unsignedTinyInteger('stratum')->nullable(); //0 a 255
            $table->unsignedTinyInteger('backyard')->nullable();

            //Media
            $table->string('images',3000)->nullable();
            $table->string('docs')->nullable();

            //Relaciones
            $table->foreignId('asesor_id')->constrained('users');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('clasification_id')->constrained('clasifications');
            $table->foreignId('deal_id')->constrained('deals');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('type_id')->constrained('types');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
