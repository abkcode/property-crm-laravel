<?php

use App\Models\PropertyType;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('api_uuid')->nullable();
            $table->string('county');
            $table->string('country');
            $table->string('town');
            $table->string('description');
            // Full Details URL - missing in API
            $table->string('address');
            $table->string('image_full');
            $table->string('image_thumbnail');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->tinyInteger('num_bedrooms');
            $table->tinyInteger('num_bathrooms');
            $table->float('price', 8, 2);
            $table->foreignIdFor(PropertyType::class);
            $table->tinyInteger('type'); // 0 - sale, 1 - rent
            $table->integer('postcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
