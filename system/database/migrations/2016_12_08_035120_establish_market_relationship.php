<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstablishMarketRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // Create table for storing clients
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

         // Create table for storing brands
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating clients to brands (Many-to-Many)
        Schema::create('client_brand', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->integer('brand_id')->unsigned();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['client_id', 'brand_id']);
        });

        Schema::create('chains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')
                ->onUpdate('cascade')->onDelete('cascade');
        });

       

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('client_chain', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->integer('chain_id')->unsigned();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('chain_id')->references('id')->on('chains')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['client_id', 'chain_id']);
        });



        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_id')->unsigned();
            $table->string('name')->unique();
            $table->integer('code')->unique();
            $table->string('display_name')->nullable();
            $table->string('address')->nullable();
            $table->string('store_type')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('chain_id')->references('id')->on('chains')
                ->onUpdate('cascade')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
        Schema::drop('client_brand');
        Schema::drop('brands');
        Schema::drop('client_chain');
        Schema::drop('chains');
        Schema::drop('products');
        Schema::drop('stores');
    }
}
