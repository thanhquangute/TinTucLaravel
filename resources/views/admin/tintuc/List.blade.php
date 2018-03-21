@extends('admin.layout.index')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên Không Dấu</th>
                            <th>Tóm Tắt</th>
                            <th>Nội dung</th>
                            <th>Nổi Bật</th>
                            <th>Loại Tin</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>{{$tt->TieuDe}}
                                    <img src="upload/tintuc/{{$tt->Hinh}}" style="height: 200px; width: 250px;"/></td>
                                <td>{{$tt->TieuDeKhongDau}}</td>
                                <td>{{$tt->TomTat}}</td>
                                <td>{{$tt->NoiDung}}</td>
                                <td>{{$tt->NoiBat}}</td>
                                <td>{{$tt->loaitin->Ten}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
