 @extends('layout.index')
 @section('content')
 <div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1>{{$tintuc->TieuDe}}</h1>
            <p class="lead">
                by <a href="#">Admin</a>
            </p>

            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead">{!!$tintuc->NoiDung!!}</p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if(Auth::check())
                <div class="well">
                    @if(session('thongbao'))
                            <div class="alert alert-succes">
                                {{session('thongbao')}}
                            </div>
                        @endif
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="comment/{{$tintuc->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="noidung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            @endif

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach($tintuc->comment as $cm)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->users->name}}
                            <small>{{$cm->created_at}}</small>
                       
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                  @foreach($tinnoibat as $tnb)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="chi-tiet-tin/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="chi-tiet-tin/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html"><b>{{$tnb->TieuDe}}</b></a>
                        </div>
                        <div class="break"></div>
                    </div>
                   @endforeach
                    <!-- end item -->
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">

                    <!-- item -->
                    @foreach($tinlienquan as $tlq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chi-tiet-tin/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chi-tiet-tin/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach
                    <!-- end item -->

                    <!-- end item -->
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
@endsection