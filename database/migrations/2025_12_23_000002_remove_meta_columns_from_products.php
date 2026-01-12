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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'meta_title') || Schema::hasColumn('products', 'meta_description') || Schema::hasColumn('products', 'meta_keywords')) {
                $table->dropColumn(array_filter([
                    Schema::hasColumn('products', 'meta_title') ? 'meta_title' : null,
                    Schema::hasColumn('products', 'meta_description') ? 'meta_description' : null,
                    Schema::hasColumn('products', 'meta_keywords') ? 'meta_keywords' : null,
                ]));
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->mediumText('meta_description')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_keywords')) {
                $table->mediumText('meta_keywords')->nullable();
            }
        });
    }
};
