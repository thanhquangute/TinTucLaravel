<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;
class TinTucController extends Controller
{
    public function getDanhSachTinTuc(){
    	$tintuc = TinTuc::all();
    	return view('admin.tintuc.List',['tintuc'=>$tintuc]);
    }
    public function getThemTinTuc(){
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	return view('admin.tintuc.Add',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThemTinTuc(Request $req){
    	 $this->validate($req,
            [
                'TheLoai' => 'required',
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'NoiDung'=>'required',
                'TomTat'=>'required'
            ],
            [
                'TheLoai.required'=>'Ban chua chọn the loai',
                'LoaiTin.required'=>'Ban chua chọn loai tin',
                'TieuDe.unique'=>'Tiêu đề tin tức đã tồn tại',
                'TieuDe.min'=>'Tieu de tin tuc phai co do dai tu 3 ki tu',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'NoiDung.required'=>' Bạn chưa nhập nội dung',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt'
            ]);

    	 $tintuc = new TinTuc;
    	 $tintuc->TieuDe = $req->TieuDe;
    	 $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
    	 $tintuc->idLoaiTin = $req->LoaiTin;
    	 $tintuc->TomTat = $req->TomTat;
    	 $tintuc->NoiDung = $req->NoiDung;
    	 $tintuc->NoiBat = $req->NoiBat;
    	 if($req->hasFile('Hinh')){
    	 	$file = $req->file('Hinh');
    	 	$duoi = $file->getClientOriginalExtension();
    	 	if($duoi != 'jpeg' && $duoi != 'jpg' && $duoi != 'png'){
    	 		return redirect('admin/tintuc/them')->with('thongbao','File bạn chọn không phải hình ảnh');
    	 	}
    	 	$name=$file->getClientOriginalName();
    	 	$Hinh = str_random(4)."_".$name;
    	 	// Kiem tra file ton tai hay k
    	 	while(file_exists("upload/tintuc".$Hinh)){
    	 		$Hinh = str_random(4)."_".$name;
    	 	}
    	 	$file->move("upload/tintuc",$Hinh);
    	 	$tintuc->Hinh = $Hinh;
    	 }
    	 else{
    	 	$tintuc->Hinh= "";
    	 }
    	 $tintuc->save();
    	 return redirect('admin/tintuc/them')->with('thongbao','Bạn đã thêm tin tức thành công');
    }
    public function getSuaTinTuc($id){
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	$tintuc = TinTuc::find($id);
    	return view('admin/tintuc/Edit',['tintuc'=>$tintuc,'loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSuaTinTuc($id, Request $req){
    	 $tintuc = TinTuc::find($id);
    	 $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
    	 $tintuc->idLoaiTin = $req->LoaiTin;
    	 $tintuc->TomTat = $req->TomTat;
    	 $tintuc->NoiDung = $req->NoiDung;
    	 $tintuc->NoiBat = $req->NoiBat;
    	 if($req->hasFile('Hinh')){
    	 	$file = $req->file('Hinh');
    	 	$duoi = $file->getClientOriginalExtension();
    	 	if($duoi != 'jpeg' && $duoi != 'jpg' && $duoi != 'png'){
    	 		return redirect('admin/tintuc/them')->with('thongbao','File bạn chọn không phải hình ảnh');
    	 	}
    	 	$name=$file->getClientOriginalName();
    	 	$Hinh = str_random(4)."_".$name;
    	 	// Kiem tra file ton tai hay k
    	 	while(file_exists("upload/tintuc".$Hinh)){
    	 		$Hinh = str_random(4)."_".$name;
    	 	}
    	 	$file->move("upload/tintuc",$Hinh);
    	 	unlink("upload/tintuc/".$tintuc->Hinh);
    	 	$tintuc->Hinh = $Hinh;
    	 }
    	 $tintuc->save();
    	 return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn đã sua tin tức thành công');
    }
    public function getXoaTinTuc($id){
    	$tintuc=TinTuc::find($id);
    	$tintuc->delete();
        return redirect('admin/tintuc/danh-sach')->with('thongbao','Xóa Tin tức Thành Công');
    }
    public function getXoaComment($idcomment, $idtintuc){
    	$comment=Comment::find($idcomment);
    	$comment->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xóa comment Thành Công');
    }
}
