<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimStatusTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_status_translation', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('task');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('claim_status_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->unique(['language_id', 'claim_status_id']);

            $table->foreign('language_id')
                ->references('id')
                ->on('language')
                ->onDelete('cascade');

            $table->foreign('claim_status_id')
                ->references('id')
                ->on('claim_status')
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
        Schema::dropIfExists('claim_status_translation');
    }
}
