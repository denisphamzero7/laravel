<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\HasFastory;
use DB;
class Users extends Model
{

 protected $table = 'users';


  public function getAllUsers($filters=[],$keywords=null,$sortBy=null,$sortByArr = null,$perPage=0){
    // $users= DB::select('SELECT * FROM users ORDER BY create_at DESC');
     DB::enableQueryLog();
    $users=DB::table($this->table)
    // chọn các cột cần hiển thị
    ->select('users.*','groups.name as group_name')
   //join bảng
   ->join('groups','users.group_id','=','groups.id');
   $orderBy='users.create_at';
   $orderType='desc';
   if(!empty($sortByArr)&& is_array($sortByArr)){

    if(!empty($sortByArr['sortBy'])&&$sortByArr['sortType']){
      $orderBy = trim($sortByArr['sortBy']);
      $orderType = trim($sortByArr['sortType']);


    }
   }
    $users= $users->orderBy( $orderBy, $orderType);
// $users= $users->orderBy('users.create_at','DESC');
   // Kiểm tra mảng model có rỗng không, nếu không thì truy vấn điều kiện bằng where
   if(!empty($filters)){
    $users =$users->where($filters);
   }
   if(!empty($keywords)){
    $users =$users->where(function($query) use($keywords) {
        $query->orwhere('fullname','like','%'.$keywords.'%');
         $query->orwhere('email','like','%'.$keywords.'%');
    });
   }
    // $users=$users->get();
    if(!empty($perPage)){
       $users=$users->paginate($perPage)->withQueryString();; // 3 bảng ghi trên 1 trang
    }else{
        $users=$users->get();
    }

    $sql=DB::getQueryLog();
    // dd($sql);
    return $users;
  }
  public function addUser($data){
    DB::insert('INSERT INTO users (fullname,email,create_at) value (?,?,?)',$data);
  }
    public function getDetail($id){
     return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
  }
  public function updateUser($data,$id){
    $data = array_merge($data,[$id]);
    return DB::update('UPDATE ' . $this->table .' SET fullname=?,email=?,update_at=? WHERE id =?',$data);
  }
  public function deleteUser($id){
    return DB::delete("DELETE FROM $this->table WHERE id=?",[$id]);
  }
  public function statementUser($sql)
  {
    return DB::statement($sql);
  }

  public function learnQueryBuilder(){
    DB::enableQueryLog();
    // tất cả bảng ghi trong table
    // $id=4;
    // $lists = DB::table($this->table)
    // ->select('fullname','email','id') //lấy thông tin các cột
    // ->where('id','=',3)// lấy bảng ghi có điều kiện id =
    // ->where('id','>',3)//lấy danh sách các bảng ghi lớn hơn 3
    // ->where('id','<',3)// lấy danh sách các bảng ghi nhỏ hơn 3
    // ->where('id','<>',3)// lấy danh sách các bảng ghi trừ bảng ghi có id =3 (!=)tương tự
    // lấy bảng ghi trong trong khoảng
    // ->where([
    //     [
    //         'id','>=',2
    //     ],
    //     [
    //         'id','<=',4
    //     ]
    // ])
    // bảng ghi or
    // ->where('id',3)
    // ->orwhere('id',2)
    // ->where('id',3)
    // ->where(function($query)use ($id){
    //     $query->where('id','<',$id)->orwhere('id','>',$id);
    // })
    // tìm kiếm sử dụng LIKE
    // ->where('fullname','like','Huynh')
    // ->get();// lấy thông tin
    // $lists = DB:: table('users')
    // ->select('users.*','groups.name as groupname')
    // ->leftjoin('groups','users.group_id','=','groups.id')->get();
    // ->select(DB::raw('count(id) as email_count'),'email','fullname')
    // ->groupBy('email')
    // ->groupBy('fullname')
    //  ->limit(2)
    //  ->offset(2)
    // ->get();
    // $insert =DB::table('users')->insert([
    //     ['fullname'=>'Phạm Ngọc Hậu','email'=>'hau@gmailcom']
    // ]);
    // $status = DB::table('users')
    // ->where('id',3)
    // ->delete();
    // Đếm số bản ghi,'
    $lists= DB::table('users')
    // ->where('id','>',0)->get();
    // $count= count($lists);
    // dd($count);
    // ->selectRaw('email,count(id) as count_id')
    // ->orderByRaw('create_at DESC, update_at ASC')
    // -> groupByRaw('email')
    // ->havingRaw('count(id) > ?',[1])
    ->where(
        'group_id',
        '=',
        function($query){
            $query ->select('id')
            ->from('groups')
            ->where('name','=','administrator');
        }
    )
    ->get();
    dd($lists);
    $sql=DB::getQueryLog();
    dd($sql);
    // Lấy bảng ghi đầu tiên
    $detail= DB::table($this->table)->first();
    // dd($detail);


  }
}
