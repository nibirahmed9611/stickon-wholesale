<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'attributes', function ( Blueprint $table ) {
            $table->id();

            $table->foreignId( 'product_id' )->unsigned()->index();
            $table->string( 'value' );
            $table->integer( 'quantity' )->default(0);

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'attributes' );
    }
}
