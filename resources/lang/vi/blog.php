<?php
return [
    'all_blog' => 'Tất Cả Bài Viết',
    'add_blog' => 'Thêm Bài Viết',
    'title' => 'Tiêu Đề',
    'content' => 'Nội Dung',
    'author' => 'Tác Giả',
    'status' => 'Trạng Thái',
    'publish_date' => 'Ngày Xuất Bản',
    'created_by' => 'Được Tạo Bởi',
    'verifited' => 'Đã Được Xác Nhận',
    'wait_verify' => 'Chờ Xác Nhận',
    'be_rejected' => 'Bị Từ Chối',
    'no_data' => 'Không Có Dữ Liệu',
];


/*----------------------------------------------------------------
 $table->string('title');
            $table->string('slug')->index('slug_index');
            $table->text('content')->nullable();
            $table->biginteger('created_user_id')->nullable();
            $table->string('cover')->nullable();
            $table->date("publish_date");
            $table->tinyInteger('is_verifited')->default(0);