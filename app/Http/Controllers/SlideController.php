<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    public function getDanhSachSlide(){
    	$slide = Slide::all();
    	return view('admin.slide.List',['slide'=>$slide]);
    }
    public function getThemSlide(){
    	return view('admin.slide.Add');
    }
    public function postThemSlide(Request $req){
    	$this->validate($req,
            [
                'TieuDe'=>'required|min:3|unique:Slide,Ten',
                'NoiDung'=>'required',
                'Link'=>'required'
            ],
            [
                'TieuDe.unique'=>'Tiêu đề tin tức đã tồn tại',
                'TieuDe.min'=>'Tieu de tin tuc phai co do dai tu 3 ki tu',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'NoiDung.required'=>' Bạn chưa nhập nội dung',
                'Link.required'=>'Bạn chưa nhập tóm tắt'
            ]);

    	 $slide = new Slide;
    	 $slide->Ten = $req->TieuDe;
    	 $slide->NoiDung = $req->NoiDung;
    	 $slide->link = $req->Link;
    	 if($req->hasFile('Hinh')){
    	 	$file = $req->file('Hinh');
    	 	$duoi = $file->getClientOriginalExtension();
    	 	if($duoi != 'jpeg' && $duoi != 'jpg' && $duoi != 'png'){
    	 		return redirect('admin/slide/them')->with('thongbao','File bạn chọn không phải hình ảnh');
    	 	}
    	 	$name=$file->getClientOriginalName();
    	 	$Hinh = str_random(4)."_".$name;
    	 	// Kiem tra file ton tai hay k
    	 	while(file_exists("upload/slide".$Hinh)){
    	 		$Hinh = str_random(4)."_".$name;
    	 	}
    	 	$file->move("upload/slide",$Hinh);
    	 	$slide->Hinh = $Hinh;
    	 }
    	 else{
    	 	$slide->Hinh= "";
    	 }
    	 $slide->save();
    	 return redirect('admin/slide/them')->with('thongbao','Bạn đã thêm slide thành công');
    }
    public function getXoaSlide($id){
    	$slide = Slide::find($id);
    	$slide->delete();
    	return redirect('admin/slide/danh-sach')->with('thongbao','Bạn đã xóa thành công slide');
    }
    public function getSuaSlide($id){
    	$slide  = Slide::find($id);
    	return view('admin.slide.Edit',['slide'=>$slide]);
    }
    public function postSuaSlide($id, Request $req){
    	$slide = Slide::find($id);
    	 $slide->Ten = $req->TieuDe;
    	 $slide->NoiDung = $req->NoiDung;
    	 $slide->link = $req->Link;
    	 if($req->hasFile('Hinh')){
    	 	$file = $req->file('Hinh');
    	 	$duoi = $file->getClientOriginalExtension();
    	 	if($duoi != 'jpeg' && $duoi != 'jpg' && $duoi != 'png'){
    	 		return redirect('admin/slide/them')->with('thongbao','File bạn chọn không phải hình ảnh');
    	 	}
    	 	$name=$file->getClientOriginalName();
    	 	$Hinh = str_random(4)."_".$name;
    	 	// Kiem tra file ton tai hay k
    	 	while(file_exists("upload/slide".$Hinh)){
    	 		$Hinh = str_random(4)."_".$name;
    	 	}
    	 	$file->move("upload/slide",$Hinh);
    	 	unlink("upload/slide/".$slide->Hinh);
    	 	$slide->Hinh = $Hinh;
    	 }
    	 $slide->save();
    	 return redirect('admin/slide/sua/'.$id)->with('thongbao','Bạn đã sua slide thành công');
    }
}
