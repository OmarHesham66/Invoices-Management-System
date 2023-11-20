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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');
            $table->dateTime('date_create_invoice');
            $table->dateTime('due_date_invoice');
            $table->enum('status', ['Paid', 'Partially paid', 'Unpaid']);
            $table->foreignId('product')->references('id')->on('products')->cascadeOnDelete();
            $table->foreignId('bank')->references('id')->on('sections')->cascadeOnDelete();
            $table->float('collection');
            $table->float('commission');
            $table->float('vat');
            $table->float('discount')->default(0);
            $table->float('total');
            $table->string('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->foreignId('user')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
