<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim', function (Blueprint $table) {
            $table->unsignedBigInteger('claim_type_id');
            $table->unsignedBigInteger('claim_status_id');
            $table->unsignedBigInteger('creditor_id');
            $table->unsignedBigInteger('debtor_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('claim_type_id')
                ->references('id')
                ->on('claim_type')
                ->onDelete('cascade');

            $table->foreign('claim_status_id')
                ->references('id')
                ->on('claim_status')
                ->onDelete('cascade');

            $table->foreign('creditor_id')
                ->references('id')
                ->on('participant')
                ->onDelete('cascade');

            $table->foreign('debtor_id')
                ->references('id')
                ->on('participant')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('claim', function (Blueprint $table) {
            $table->dropColumn('claim_type_id');
            $table->dropColumn('claim_status_id');
            $table->dropColumn('creditor_id');
            $table->dropColumn('debtor_id');
            $table->dropColumn('user_id');
        });
    }
}
