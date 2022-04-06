<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderCommentOnOrderTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'orders', function ( Blueprint $table ) {
            $table->longText( "comment" )->nullable();
            $table->boolean( "is_seen" )->default( false );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'orders', function ( Blueprint $table ) {
            $table->dropColumn( "comment" );
            $table->dropColumn( "is_seen" );
        } );
    }
}
