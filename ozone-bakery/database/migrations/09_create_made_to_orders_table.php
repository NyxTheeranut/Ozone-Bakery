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
        Schema::create('made_to_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->unsignedInteger('price');
            $table->enum('order_status', ['Evaluating', 'Negotiating', 'In Progress', 'Waiting', 'Complete', 'Rejected'])->default('Evaluating');
            $table->date('pickup_date');
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('made_to_orders');
    }
};
