<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutstandingBalanceToInvoicesTable extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Adding the outstanding_balance column with a default value of 0
            $table->decimal('outstanding_balance', 10, 2)->default(0)->after('total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Remove the outstanding_balance column if we rollback the migration
            $table->dropColumn('outstanding_balance');
        });
    }
}
