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
        Schema::create('transactions-invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->nullOnDelete();
            $table->enum('status', ['Paid', 'Partially paid', 'Unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions-invoices');
    }
};
