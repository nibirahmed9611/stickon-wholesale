<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'order_products', function ( Blueprint $table ) {
            $table->id();

            $table->foreignId( 'order_id' )->unsigned()->index();
            $table->foreignId( 'product_id' )->unsigned()->index();
            $table->foreignId( 'attribute_id' )->unsigned()->index();
            $table->float( 'quantity' )->default(1);
            $table->string( 'status' )->default('Processing');

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'order_products' );
    }
}
