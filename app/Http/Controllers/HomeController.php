<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
 public $data =[];
 public function index(){
    $this->data['wellcome']='Học lập trình php';
    // $users = DB::select('select * from users where email=:email',[
    //     'email'=>'phuong@gmail.com'
    // ]);
    // dd($users);
    $this->data['Arr']=[
        '1'=>'Hậu',
        '2'=>'Thương',
        '3'=>'Phước',
        '4'=>'Nhân'
    ];
    $this-> data['title']='welll come to laravel';
    return view('clients.home',$this->data);
  }


     // Lấy chi tiết sản phẩm
  public function getDetailProduct($id){
    return view('clients.products.detail',compact('id'));
  }
   public function getProduct(){

    return view('clients.products');
  }

   public function getaddProduct(){
     $this->data['errorMessage']='Vui lòng kiểm tra dữ liệu';
    return view('clients.add',$this->data);
  }
  public function addProduct(Request $request){
    $inputs =$request->all();
    // dd($request->all());
    $rules =[
         'product_name'=>['required','min:6',new Uppercase],
        'product_price'=>'required|integer'
    ];
    $attributes=[
        'product_name'=>'Tên sản phẩm',
        'product_price'=>'Giá sản phẩm'
    ];
    $messages =[
        'required'=>'Trường :attribute bắt buộc phải nhập',
        'min'=>'Tên đăng nhập không nhỏ hơn :min kí tự',
        'required'=>'Thiếu trường :attribute',
        'integer'=>'Trường :attribute phải số'
    ];
  $validator=Validator::make($inputs,$rules,$messages,$attributes);
//    $validator->validate();
if ($validator->fails()) {
            // Nếu có lỗi thì thêm msg và quay lại trang cũ
            $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    // $request->validate($rule, $message);
//   $messages =[
//         'product_name.required'=>'Trường  bắt buộc phải nhập',
//         'product_name.min'=>'Tên đăng nhập không nhỏ hơn :min kí tự',
//         'product_price.required'=>'Thiếu trường',
//         'product_price.integer'=>'Trường  phải số'
//     ];


     // sử lý việc thêm database
  }
  // Lưu ý hàm dowload chỉ áp dụng local
  // Sử dụng streamdowload để dowload link bên ngoài

// public function dowloadImage(Request $request){
//     // Kiểm tra xem có tham số image gửi lên không
//     if($request->has('image')){

//         // LỖI 1: Bỏ dấu $ trước chữ trim
//         $image = trim($request->image);
//         $filename= 'image_'.uniqid().'jpg';
//         // LỖI 2: Sửa streamdowload thành streamDownload (thêm chữ n)
//         // return response()->streamDownload(function() use ($image){

//         //     // Lấy nội dung ảnh từ link
//         //     $imageContent = file_get_contents($image);
//         //     echo $imageContent;

//         // }, $filename); // Tên file khi tải về
//         return response()->download($image);

//     } else {
//         return "Không có link ảnh";
//     }
// }

public function dowloadImage(Request $request){
    // Kiểm tra xem có tham số image gửi lên không
    if(!empty($request->image)){
        $image = trim($request->image);
        $filename =basename($image);

        return response()->download($image);
    }
}


}
