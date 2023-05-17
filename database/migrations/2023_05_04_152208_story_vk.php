<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoryVk extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('story_vk', function (Blueprint $table) {
            $table->id();
            $table->string('vk_id')->nullable();                    ///*/ Идентификатор пользователя VK ///*/
            $table->string('tg_id')->nullable();                    ///*/ Идентификатор пользователя TG ///*/
            $table->text('message')->nullable();                    ///*/ Сообщение пользователя из запроса ///*/
            $table->integer('deposit')->nullable();                 ///*/ Залог запроса ///*/
            $table->text('story')->nullable();                      ///*/ Залог запроса ///*/
            
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('story_vk');}
}
