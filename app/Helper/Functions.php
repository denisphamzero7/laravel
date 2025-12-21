<?php
use App\Models\Groups;
function isUppercase($value,$message,$fail){
    if($value!=mb_strtoupper($value,'UFT-8')){
        $fail($message);
    }
}

function getAllGroups(){
  // Khởi tạo đối tượng Groups mới rồi mới gọi hàm getAll
    $groups = new Groups();
    return $groups->getAll();
}
