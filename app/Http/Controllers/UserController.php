<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class UserController extends Controller
{
    /*
    * Class constructor
     */
    private $users;
    const _PER_PAGE=5;
    public function __construct(){
      $this-> users= new Users();
    }
    // danh sách người dùng
    public function index(Request $request){
    $title = 'Danh sách người dùng';
    // $this->users->learnQueryBuilder();
    // Muốn lọc sử lí phần controller, đưa 1 biến có tên là $filter , tiếp theo qua model để biến chỗ getAllUser cũng có tên $filters
    // để lọc được phải bắt các input từ query, thêm Request $request vào tham số hàm index
    // kiểm tra các trường có trong query nếu có thì truy vấn theo điều kiện
    // controller kiểm tra key truy vấn có không nếu có thì gán vô mảng lọc tiếp tới đến phần model
    // Tìm kiếm đầu vào request là keyword
    // khởi tạo biến này ở controller là null
    // nếu không trống thì sẽ gán vô biến $keyword
    // thêm biến $keyword vào userlist -> vô model
    // dùng hàm kiểm tra điều kiện hoặc có thể kiểm tra nhiều cột có trùng với keyword nếu trùng in ra
    // danh sách có trùng với các điều kiện
//       if(!empty($keywords)){
//     $users =$users->where(function($query) use($keywords) {
//         $query->orwhere('fullname','like','%'.$keywords.'%');
//          $query->orwhere('email','like','%'.$keywords.'%');
//     });
//    }

    $filters=[];
    $keywords=null;
    if(!empty($request->status)){
        $status=$request->status;
        if($status=='active'){
            $status =1;
        }else{
            $status=0;
        }
        $filters[]=['users.status','=',$status];

    }
      if(!empty($request->group_id)){
        $group_Id=$request->group_id;

        $filters[]=['users.group_id','=', $group_Id];

    }
      if(!empty($request->keywords)){
        $keywords=$request->keywords;

    }
    // xử lí logic sắp xếp
    // $sortBy='fullname';
    $sortBy=$request->input('sort-by');
    $sortType=$request->input('sort-type');
    // tạo mảng để tránh người dùng sửa
    $alowSort=['asc','desc'];
    if(!empty($sortType)&& in_array($sortType,$alowSort)){
         if($sortType=='desc'){
        $sortType='asc';
    }else{
        $sortType ='desc';
    }
    }else{
       $sortType = 'asc';
    }
    $sortByArr=[
        'sortBy'=>$sortBy,
        'sortType'=> $sortType
    ];

    $userList =$this-> users->getAllUsers($filters,$keywords, $sortBy=null,$sortByArr,self::_PER_PAGE);


    return view('clients.user.lists',compact('title','userList','sortType'));
  }

  // form add
  public function add(){
   // nơi này sẽ là form add user
   $title = 'Thêm mới người dùng';
   return view('clients.user.add',compact('title'));

  }
  public function postadd(Request $request){
  $request->validate([
    'fullname'=>'required|min:5',
    'email'=>'required|email|unique:users'
  ],[
    'fullname.required'=>'Vui lòng nhập tên',
    'fullname.min'=>'Vui lòng nhập :min kí tự trở lên',
    'email.required'=>' Vui lòng nhập email',
    'email.email'=>'Email không đúng định dạng',
    'email.unique'=>'Email đã tồn tại trên hệ thống'
  ]);
   $dataInsert=[
    $request->fullname,
    $request->email,
    date('Y-m-d H:i:s')
   ];

  $this->users->addUser($dataInsert);
      return redirect()-> route('users.index')->with('msg','Thêm người thành công');
  }
   public function getEdit(Request $request,$id=0){
//    dd($request);

   $title = 'Chỉnh sửa người dùng';
   if(!empty($id)){
       $userDetail= $this->users->getDetail($id);
       if(!empty($userDetail[0])){
        $request->session()->put('id',$id);
        $userDetail= $userDetail[0];
       }else{
        return redirect()->route('users.index')->with('msg','Người dùng không tồn tại ');
       }

   }else{
    return redirect()->route('users.index')->with('msg','Liên kết không tồn tại');
   }
   return view('clients.user.edit',compact('title','userDetail'));

   }
public function postEdit(Request $request) {
    $id = session('id');

    if (empty($id)) {
        return back()->with('msg', 'Liên kết không tồn tại');
    }

    $request->validate([
        'fullname' => 'required|min:5',
        // SỬA LỖI TẠI ĐÂY: Thêm ,email, để định nghĩa cột và ID cần bỏ qua
        'email' => 'required|email|unique:users,email,' . $id
    ], [
        'fullname.required' => 'Vui lòng nhập tên',
        'fullname.min' => 'Vui lòng nhập :min kí tự trở lên',
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không đúng định dạng',
        'email.unique' => 'Email đã tồn tại trên hệ thống'
    ]);

    $dataUpdate = [
        $request->fullname,
        $request->email,
        date('Y-m-d H:i:s')
    ];

    // Cập nhật
    $this->users->updateUser($dataUpdate, $id);

    return back()->with('msg', 'Cập nhật thành công');
}
public function delete($id=0){
     if(!empty($id)){
       $userDetail= $this->users->getDetail($id);
       if(!empty($userDetail[0])){
        $deletestatus= $this->users-> deleteUser($id);
        if($deletestatus){
           $msg='Xoá thành công';
        }else{
           $msg='Bạn không thể xoá người dùng lúc này';
        }
       }else{
        $msg='Người dùng không tồn tại';;
       }

   }else{
     $msg='Liên kết không tồn tại';
   }
     return back()->with('msg',$msg);
}
}