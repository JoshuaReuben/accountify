<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Make if foreign ID later
            $table->string('payer_name');
            // $table->string('user_id');
            // $table->string('payer_email'); or kasama na sa user id


            $table->string('payment_id');
            $table->string('currency');


            $table->string('payment_method');
            $table->string('payment_status');

            $table->string('quantity');
            $table->string('amount');

            // What Product did they availed
            // $table->string('order_id');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
