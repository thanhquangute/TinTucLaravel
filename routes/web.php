<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin', function(){
	return view('admin.layout.index');
});
Route::get('them', function(){
	return view('admin.theloai.List');
});
Route::get('admin/dang-nhap','UserController@getDangNhapAdmin');
Route::post('admin/dang-nhap','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');
Route::group(['prefix'=>'admin'], function(){
	//admin/theloai/danhsach,
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danh-sach','TheLoaiController@getDanhSachTheLoai');
		Route::get('sua/{id}','TheLoaiController@getSuaTheLoai');
		Route::post('sua/{id}','TheLoaiController@postSuaTheLoai');
		Route::get('them','TheLoaiController@getThemTheLoai');
		Route::post('them','TheLoaiController@postThemTheLoai');
		Route::get('xoa/{id}','TheLoaiController@getXoaTheLoai');
	});
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danh-sach','LoaiTinController@getDanhSachLoaiTin');
		Route::get('sua/{id}','LoaiTinController@getSuaLoaiTin');
		Route::post('sua/{id}','LoaiTinController@postSuaLoaiTin');
		Route::get('them','LoaiTinController@getThemLoaiTin');
		Route::post('them','LoaiTinController@postThemLoaiTin');
		Route::get('xoa/{id}','LoaiTinController@getXoaLoaiTin');
	});
	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}/{idTinTuc}','TinTucController@getXoaComment');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danh-sach','TinTucController@getDanhSachTinTuc');
		Route::get('sua/{id}','TinTucController@getSuaTinTuc');
		Route::post('sua/{id}','TinTucController@postSuaTinTuc');
		Route::get('them','TinTucController@getThemTinTuc');
		Route::post('them','TinTucController@postThemTinTuc');
		Route::get('xoa/{id}','TinTucController@getXoaTinTuc');
	});
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danh-sach','SlideController@getDanhSachSlide');
		Route::get('sua/{id}','SlideController@getSuaSlide');
		Route::post('sua/{id}','SlideController@postSuaSlide');
		Route::get('them','SlideController@getThemSlide');
		Route::post('them','SlideController@postThemSlide');
		Route::get('xoa/{id}','SlideController@getXoaSlide');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('danh-sach','UserController@getDanhSachUser');
		Route::get('sua/{id}','UserController@getSuaUser');
		Route::post('sua/{id}','UserController@postSuaUser');
		Route::get('them','UserController@getThemUser');
		Route::post('them','UserController@postThemUser');
		Route::get('xoa/{id}','UserController@getXoaUser');
	});
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTinByTheLoai');	
	});	
});
// guest

	Route::get('trang-chu','GuestController@trangchu');
	Route::get('dang-nhap','GuestController@getdangnhap');
	Route::get('dang-xuat','GuestController@getdangxuat');
	Route::post('comment/{id}','GuestController@postComment');
	Route::post('dang-nhap','GuestController@postdangnhap');
	Route::get('loai-tin/{id}/{TenKhongDau}.html','GuestController@loaitin');
	Route::get('chi-tiet-tin/{id}/{TieuDeKhongDau}.html','GuestController@chitiettin');
	Route::get('thong-tin-tai-khoan','GuestController@getThongTinTaiKhoan');
	Route::post('thong-tin-tai-khoan','GuestController@postThongTinTaiKhoan');
	Route::post('tim-kiem','GuestController@timkiem');
