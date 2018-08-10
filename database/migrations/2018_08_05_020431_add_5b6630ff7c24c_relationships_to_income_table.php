<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b6630ff7c24cRelationshipsToIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function(Blueprint $table) {
            if (!Schema::hasColumn('incomes', 'income_category_id')) {
                $table->integer('income_category_id')->unsigned()->nullable();
                $table->foreign('income_category_id', '191856_5b63bdfc7aff3')->references('id')->on('income_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'branch_id')) {
                $table->integer('branch_id')->unsigned()->nullable();
                $table->foreign('branch_id', '191856_5b63c48adcdf1')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('incomes', function(Blueprint $table) {
            
        });
    }
}
