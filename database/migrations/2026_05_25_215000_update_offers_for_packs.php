<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add pack_price to offers
        Schema::table('offers', function (Blueprint $table) {
            $table->decimal('pack_price', 10, 2)->nullable()->after('bg_color');
        });

        // Create pivot table offer_product
        Schema::create('offer_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_product');
        
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('pack_price');
        });
    }
};
