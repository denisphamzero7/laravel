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
    {     // Kiểm tra nếu bảng 'posts' chưa tồn tại
        if(!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->timestamps();
            });
        }
        // muốn thay đổi bảng đã tồn tại
        if(Schema::hasColumn('posts','title')){ {
            // cột 'posts' đã tồn tại, không làm gì cả
            return;
        }
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
