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
        //Tạo khóa ngoại cho bảng users liên kết với bảng user_groups
        Schema::table('users',function(Blueprint $table){
            // Thêm cột group_id nếu chưa tồn tại
            if(!Schema::hasColumn('users', 'group_id')){
                $table->unsignedBigInteger('group_id')->nullable()->after('id');
            }
        });

        // Tạo foreign key nếu chưa tồn tại
        Schema::table('users',function(Blueprint $table){
            if(Schema::hasColumn('users', 'group_id') && Schema::hasTable('user_groups')){
                $table->foreign('group_id')->references('id')->on('user_groups')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'group_id')) {
            // 1. Xóa Foreign Key trước (Bắt buộc)
            // Tên mặc định thường là: users_group_id_foreign
            try {
                $table->dropForeign(['group_id']);
            } catch (\Exception $e) {
                // Bỏ qua nếu không tìm thấy foreign key
            }

            // 2. Xóa Index (Nên làm để sạch DB)
            // Tên mặc định thường là: users_group_id_index
            try {
                $table->dropIndex(['group_id']);
            } catch (\Exception $e) {
                // Bỏ qua nếu không tìm thấy index
            }

            // 3. Cuối cùng mới xóa cột
            $table->dropColumn('group_id');
        }
    });
}
};
