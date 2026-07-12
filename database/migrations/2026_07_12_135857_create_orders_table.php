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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('voucher_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('total_price',10,2);

            $table->enum('status',[
                'pending',
                'paid',
                'processed',
                'shipped',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamp('order_date');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
