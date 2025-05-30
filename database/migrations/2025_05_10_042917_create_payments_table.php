<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade'); 
            $table->decimal('amount_paid', 10, 2); 
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); 
            $table->timestamp('paid_at')->nullable(); 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
