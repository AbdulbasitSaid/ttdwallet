<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b653d807c7de5b653d807a3e0InternalNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('internal_notification_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('internal_notification_user')) {
            Schema::create('internal_notification_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('internal_notification_id')->unsigned()->nullable();
            $table->foreign('internal_notification_id', 'fk_p_191852_191851_user_i_5b63bd1095459')->references('id')->on('internal_notifications');
                $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_p_191851_191852_intern_5b63bd1094799')->references('id')->on('users');
                
                $table->timestamps();
                
            });
        }
    }
}
