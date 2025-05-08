<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{

    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();

            $table->string('cardholder_name');
            $table->string('card_number'); 
            $table->char('expiration_month', 2); 
            $table->char('expiration_year', 4);  

            
            $table->string('security_code')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
}
