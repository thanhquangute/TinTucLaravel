<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
   public function getDanhSachTheLoai(){
   		$theloai  = TheLoai::all();
   		return view('admin.theloai.List',['theloai'=>$theloai]);
   }
   public function getSuaTheLoai($id){
    	$theloai = TheLoai::find($id);
        return view('admin.theloai.edit',['theloai'=>$theloai]);
    }
    public function postSuaTheLoai(Request $request, $id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten the loai',
                'Ten.unique'=>'Ten the loai da ton tai',
                'Ten.min'=>'Ten the loai phai co do dai tu 3 ki tu',
                'Ten.max'=>'Ten the loai phai co do dai nho hon 100 ki tu'
            ]);

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thể loại thành công');
    }
    public function getThemTheLoai(){
    	return view('admin.theloai.add');
    }
    public function postThemTheLoai(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten the loai',
                'Ten.min'=>'Ten the loai phai co do dai tu 3 ki tu',
                'Ten.max'=>'Ten the loai phai co do dai nho hon 100 ki tu'
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm Thể Loại Thành Công');
    }
    public function getXoaTheLoai($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danh-sach')->with('thongbao','Xóa Thể Loại Thành Công');
    }
}
