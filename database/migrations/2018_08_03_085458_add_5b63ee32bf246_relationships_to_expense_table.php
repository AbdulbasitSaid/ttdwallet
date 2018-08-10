<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b63ee32bf246RelationshipsToExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function(Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'expense_category_id')) {
                $table->integer('expense_category_id')->unsigned()->nullable();
                $table->foreign('expense_category_id', '191857_5b63bdfdc20ef')->references('id')->on('expense_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'branc_id')) {
                $table->integer('branc_id')->unsigned()->nullable();
                $table->foreign('branc_id', '191857_5b63ee324ba3e')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('expenses', function(Blueprint $table) {
            
        });
    }
}
