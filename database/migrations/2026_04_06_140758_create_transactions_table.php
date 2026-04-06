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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('account_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('saving_goal_id')->nullable()->constrained()->onDelete('set null');
        
        // Tambahkan type untuk mempermudah filter di laporan
        $table->enum('type', ['income', 'expense', 'saving']); 
        
        $table->decimal('amount', 15, 2);
        $table->text('description')->nullable();
        $table->string('attachment')->nullable();
        $table->date('date');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
