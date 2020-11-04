<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimStatusHasSmsNtfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_status_has_sms_ntf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_status_id');
            $table->unsignedBigInteger('sms_ntf_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('claim_status_id')->references('id')->on('claim_status')->onDelete('cascade');
            $table->foreign('sms_ntf_id')->references('id')->on('sms_notification')->onDelete('cascade');

            $table->unique(['claim_status_id','sms_ntf_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_status_has_sms_ntf');
    }
}
