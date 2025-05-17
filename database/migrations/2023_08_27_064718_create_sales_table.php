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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partnership_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('code');
            $table->date('date');
            $table->string('payment_method', 50)->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->text('notes')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_method')->references('name')->on('payment_methods');
            $table->foreign('status')->references('name')->on('sale_statuses');
            $table->foreign('partnership_id')->references('id')->on('partnerships');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
