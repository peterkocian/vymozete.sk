<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsNotificationTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_notification_translation', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('sms_ntf_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->unique(['language_id', 'sms_ntf_id']);

            $table->foreign('language_id')
                ->references('id')
                ->on('language')
                ->onDelete('cascade');

            $table->foreign('sms_ntf_id')
                ->references('id')
                ->on('sms_notification')
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
        Schema::dropIfExists('sms_notification_translation');
    }
}
