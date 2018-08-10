<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533275847ExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            if(Schema::hasColumn('expenses', 'branc_id')) {
                $table->dropForeign('191857_5b63ee324ba3e');
                $table->dropIndex('191857_5b63ee324ba3e');
                $table->dropColumn('branc_id');
            }
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
                        
        });

    }
}
