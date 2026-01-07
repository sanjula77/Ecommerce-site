<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop old foreign key and column
            $table->dropForeign(['cart_id']);
            $table->dropColumn('cart_id');
            
            // Add new columns
            $table->foreignId('order_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending')->after('amount');
            
            // Change card_number and cvv to text for encrypted data
            $table->text('card_number')->change();
            $table->text('cvv')->change();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn(['order_id', 'payment_status']);
            
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->string('card_number')->change();
            $table->string('cvv')->change();
        });
    }
};

