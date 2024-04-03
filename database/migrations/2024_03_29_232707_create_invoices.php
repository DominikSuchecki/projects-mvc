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
            $table->unsignedBigInteger('client_id');
            $table->string('invoice_number');
            $table->date('issue_date');
            $table->date('sale_date');
            $table->decimal('gross_value', 8, 2);
            $table->decimal('net_value', 8, 2);
            $table->string('words_value');
            $table->decimal('vat', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->string('status')->default('draft');
            $table->string('payment_method');
            $table->string('payment_date');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
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
