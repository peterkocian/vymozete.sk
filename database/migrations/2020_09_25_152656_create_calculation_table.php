<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->float('amount',10,2);
            $table->text('description');
            $table->boolean('paid')->default(0);
            $table->unsignedBigInteger('claim_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('claim_id')
                ->references('id')
                ->on('claim')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')
                ->on('currency')
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
        Schema::dropIfExists('calculation');
    }
}
