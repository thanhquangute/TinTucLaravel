<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    public function getDanhSachLoaiTin(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.List',['loaitin'=>$loaitin]);
    }
    public function getThemLoaiTin(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.Add',['theloai'=>$theloai]);
    }
    public function postThemLoaiTin(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten the loai',
                'Ten.unique'=>'Tên loại tin đã tồn tại',
                'Ten.min'=>'Ten the loai phai co do dai tu 3 ki tu',
                'Ten.max'=>'Ten the loai phai co do dai nho hon 100 ki tu',
                'TheLoai'=>' Bạn chưa chọn thể loại'
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Them Thanh Cong');
    }
    public function getXoaLoaiTin($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danh-sach')->with('thongbao','Xóa Thể Loại Thành Công');
    }
     public function getSuaLoaiTin($id){
     	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSuaLoaiTin(Request $request, $id){
        $loaitin = LoaiTin::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100',
            ],
            [
                'Ten.required'=>'Ban chua nhap ten the loai',
                'Ten.min'=>'Ten the loai phai co do dai tu 3 ki tu',
                'Ten.max'=>'Ten the loai phai co do dai nho hon 100 ki tu',
            ]);

        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thể loại thành công');
    }
}
