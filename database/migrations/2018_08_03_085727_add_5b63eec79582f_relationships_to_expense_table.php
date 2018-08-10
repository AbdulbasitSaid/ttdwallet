<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b63eec79582fRelationshipsToExpenseTable extends Migration
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
                if (!Schema::hasColumn('expenses', 'branch_id')) {
                $table->integer('branch_id')->unsigned()->nullable();
                $table->foreign('branch_id', '191857_5b63eec74fccf')->references('id')->on('users')->onDelete('cascade');
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
