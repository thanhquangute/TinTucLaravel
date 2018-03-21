<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function getDanhSachUser(){
    	$user = User::all();
    	return view('admin.user.List',['user'=>$user]);
    }
    public function getThemUser(){
    	return view('admin.user.Add');
    }
    public function postThemUser(Request $req){
    	 $this->validate($req,
            [
                'TieuDe' => 'required',
                'Email'=>'required|unique:Users,Email',
                'password'=>'required',
                'password_same'=>'required|same:password'
            ],
            [
                'TieuDe.required'=>'Ban chua nhap ten',
                'Email.required'=>'Ban chua nhập email',
                'Email.unique'=>'Email đã tồn tại',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password_same.required'=>' Bạn chưa nhập lại mật khẩu',
                'password_same.same'=>'Mật khẩu nhập lại không khớp'
            ]);
    	$user = new User;
    	$user->name = $req->TieuDe;
    	$user->email = $req->Email;
    	$user->quyen =$req->quyen;
    	$user->password = bcrypt($req->password);
    	$user->save();
    	return redirect('admin/user/them')->with('thongbao','Thêm user thành công');
    }
    public function getXoaUser($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/user/danh-sach')->with('thongbao','Xóa User thành công');
    }
    public function getSuaUser($id){
    	$user = User::find($id);
    	return view('admin.user.Edit',['user'=>$user]);
    }
    public function postSuaUser($id, Request $req){
    	$user = User::find($id);
    	$user->name = $req->TieuDe;
    	$user->quyen =$req->quyen;
    	$user->save();
    	return redirect('admin/user/sua/'.$id)->with('thongbao','Ban da sua user thanh cong');
    }
    public function getDangNhapAdmin(){
        return view('admin.login');
    }
    public function postDangNhapAdmin(Request $req){
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
                if('quyen' == 1){
                    return redirect('admin/dang-nhap')->with('thongbao','Ban khong co quyen truy cap trang nay');
                }
                else{
                    return redirect('admin/tintuc/danh-sach');
                }
                
            }
        return  redirect('admin/dang-nhap')->with('thongbao','Sai taikhoan hoac mat khau');
    }
    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dang-nhap');
    }
}
	