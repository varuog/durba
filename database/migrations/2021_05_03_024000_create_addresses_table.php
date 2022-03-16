<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->string('steert_name');
            $table->string('building_name');
            $table->string('locality');
            $table->string('landmark');
            $table->string('city');
            $table->string('pin_code');
            $table->string('contact_mobile');
            $table->enum('address_type' , config('durba.user.address-types'));
            $table->boolean('is_default_address')->default(0);
            $table->decimal('latitude', 10, 8)
                ->nullable()
                ->comment('to be updated from google service. null means');
            $table->decimal('longitude', 11, 8)
                ->nullable()
                ->comment('to be updated from google service. null means');
            // $table->point('lat_lng_location')
            //     ->comment('lat long in geois cordinates');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
