<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->id();

            $table->foreignId( "user_id" )->unsigned()->index()->nullable();
            $table->float( "subtotal" )->default( 0 );
            $table->float( "discount" )->default( 0 );
            $table->float( "total" )->default( 0 );
            $table->float( "paid" )->default( 0 );
            $table->float( "due" )->default( 0 );
            $table->string( "status" )->default( 'Processing' );

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'orders' );
    }
}
