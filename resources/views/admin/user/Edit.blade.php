@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="TieuDe" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="Email" class="form-control" value="{{$user->email}}" disabled="true" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" value="{{$user->password}}" class="form-control" disabled="true" />
                            </div>
                            <div class="form-group">

                                <label>Quyền</label>
                                @if($user->quyen==0)
                                    <label class="radio-inline">
                                        <input type="radio" name="quyen" checked="" value="0">User
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="quyen" value="1">Admin
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        <input type="radio" name="quyen" value="0">User
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="quyen" checked="" value="1">Admin
                                    </label>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

