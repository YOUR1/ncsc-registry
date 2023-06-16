<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvisoriesVersionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'advisories', function( Blueprint $table ) {
            $table->string( 'version' )->nullable();
            $table->string( 'title' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'advisories', function( Blueprint $table ) {
            $table->dropColumn( [ 'version', 'title' ] );
        } );
    }
}
