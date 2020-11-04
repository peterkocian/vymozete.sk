<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailNotificationTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_notification_translation', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('text');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('email_ntf_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->unique(['language_id', 'email_ntf_id']);

            $table->foreign('language_id')
                ->references('id')
                ->on('language')
                ->onDelete('cascade');

            $table->foreign('email_ntf_id')
                ->references('id')
                ->on('email_notification')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_notification_translation');
    }
}
