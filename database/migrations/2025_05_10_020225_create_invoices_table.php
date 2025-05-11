<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['unpaid', 'paid', 'partial'])->default('unpaid');
            $table->timestamp('issued_at')->useCurrent();
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });       
    }

    
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
}

