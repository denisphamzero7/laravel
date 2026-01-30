<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // only run if table exists and column missing
        if (Schema::hasTable('group') && ! Schema::hasColumn('group', 'permissions')) {
            Schema::table('group', function (Blueprint $table) {
                $table->string('permissions')->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('group') && Schema::hasColumn('group', 'permissions')) {
            Schema::table('group', function (Blueprint $table) {
                $table->dropColumn('permissions');
            });
        }
    }
};
