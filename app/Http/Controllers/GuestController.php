<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
class GuestController extends Controller
{
    //slide
    function __construct(){
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai', $theloai);
    	view()->share('slide', $slide);
    	if(Auth::check()){
    		view()->share('nguoidung', Auth::user());
    	}
    }
     function trangchu(){
    	//$theloai = TheLoai::all();
    	//$slide = Slide::all();
    	return view('page.home');
    }
    function loaitin($id){
    	$loaitin=LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
    	return view('page.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function chitiettin($id){
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('page.chitiet',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    function getdangnhap(){
    	return view('page.login');
    }
    function postdangnhap(Request $req){
    	$this->validate($req,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'password'=>'Bạn chưa nhập mật khẩu'
            ]);
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
            {
                    return redirect('trang-chu');
               
            }
            return redirect('dang-nhap')->with('thongbao','Đăng nhập không thành công');
    }
    function getdangxuat(){
    	Auth::logout();
    	return redirect('trang-chu');
    }
    public function postComment($id, Request $req){
    	$idTinTuc = $id;
    	$tintuc = TinTuc::find($id);
    	$comment = new Comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $req->noidung;
    	$comment->save();
    	return redirect('chi-tiet-tin/$id/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','BÌnh luận thành công');
    }
    public function getThongTinTaiKhoan(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('page.account',['user'=>$user]);
    }
    public function postThongTinTaiKhoan( Request $request){
    	$this->validate($request,
            [
                          
                'name'  => 'required',
                'password' => 'required',
                'passwordAgain'=> 'required|same:password',
            ],
            [
                
                'name.required'=>'Bạn chưa nhập ten',
                'password.required'=>'Bạn chưa nhập mat khua',
                'passwordAgain.required'=>'Ban chua nhap lai mat khau',    
                'passwordAgain.same'=>'Mat khau nhap lai khong khop',               
            ]);
			$id = Auth::user()->id;
	    	$user = User::find($id);
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
           $user->save();
           return redirect('thong-tin-tai-khoan')->with('thongbao','Capnhat thong tin tai khoan thanh cong');
           }
           function timkiem(Request $req){
           		$tukhoa = $req->TimKiem;
           		$tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->take(30)->paginate(5);
           		return view('page.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
           }

}