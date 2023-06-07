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
        Schema::create('bills', function (Blueprint $table) {

            $table->id();
            $table->string('bill_number');
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('product');
            $table->foreignId('category_id')->constrained('categories');
            $table->decimal('amount_collection' , 7 , 2) ;
            $table->decimal('amount_commission' , 7  , 2) ;
            $table->decimal('discount' , 7 , 2) ;
            $table->decimal('value_VAT' , 7 ,2) ;
            $table->string('rate_VAT') ;
            $table->decimal('total' , 8 , 2 );
            $table->string('status' , 50 );
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
