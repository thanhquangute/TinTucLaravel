@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa Tin tức
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    <!--Kiem tra loi-->
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        <!-- In thong bao -->
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    <option value="0">Chọn thể loại</option>
                                    @foreach($theloai as $tl)
                                        <option 
                                            @if($tintuc->loaitin->theloai->id == $tl->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    <option value="0">Chọn Loại tin</option>
                                    @foreach($loaitin as $lt)
                                        <option <option 
                                            @if($tintuc->loaitin->id == $lt->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề tin tức</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="5">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                               <p> <img src="upload/tintuc/{{$tintuc->Hinh}}" style="width: 100%; height: 100%;"/> </p>
                                <input class="form-control" type="file" name="Hinh" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                @if($tintuc->NoiBat == 0)
                                    <label class="radio-inline">
                                        <input type="radio" name="NoiBat" checked="" value="0">Không nổi bật
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="NoiBat" value="1">Nổi bật
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        <input type="radio" name="NoiBat" value="0">Không nổi bật
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="NoiBat" checked="" value="1">Nổi bật
                                    </label>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>User</th>
                                <th>Nội Dung</th>
                                <th>Thời gian</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cm->id}}</td>
                                    <td>{{$cm->users->name}}</td>
                                    <td>{{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

@section('script')
    <!--Lay danh sach Loai tintheo the loai khi click 1 the loai-->
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                })
            });
        });
    </script>
@endsection