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
            // Thay đổi cột description và thêm cột price
            $table->text('description')->nullable()->change();
            if(!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 8, 2);
            }
            // Lưu ý: timestamps() thường đã có sẵn, nếu thêm lại sẽ lỗi Duplicate column.
            // Nếu bảng products chưa có timestamps thì mới để dòng dưới.
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Khi rollback, ta chỉ xóa cột price vừa thêm
            if(Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }

            // (Tùy chọn) Revert cột description về trạng thái cũ nếu cần
            // $table->text('description')->nullable(false)->change();
        });
    }
};
