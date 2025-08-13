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
        Schema::table('tables', function (Blueprint $table) {
            if (!Schema::hasColumn('tables', 'grid_row')) {
                $table->integer('grid_row')->nullable();
            }
            if (!Schema::hasColumn('tables', 'grid_col')) {
                $table->integer('grid_col')->nullable();
            }
            if (!Schema::hasColumn('tables', 'grid_width')) {
                $table->integer('grid_width')->default(1);
            }
            if (!Schema::hasColumn('tables', 'grid_height')) {
                $table->integer('grid_height')->default(1);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            if (Schema::hasColumn('tables', 'grid_row')) {
                $table->dropColumn('grid_row');
            }
            if (Schema::hasColumn('tables', 'grid_col')) {
                $table->dropColumn('grid_col');
            }
            if (Schema::hasColumn('tables', 'grid_width')) {
                $table->dropColumn('grid_width');
            }
            if (Schema::hasColumn('tables', 'grid_height')) {
                $table->dropColumn('grid_height');
            }
        });
    }
};
