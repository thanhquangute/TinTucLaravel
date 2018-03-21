<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="#">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search" action="tim-kiem" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search" name="TimKiem">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			    </form>
                @if(!Auth::check())
			    <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="dang-ky">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dang-nhap">Đăng nhập</a>
                    </li>
                </ul>
                @else
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a>
                            <span class ="glyphicon glyphicon-user"></span>
                            {{Auth::user()->name}}
                        </a>
                    </li>

                    <li>
                        <a href="dang-xuat">Đăng xuất</a>
                    </li>
                </ul>
                @endif
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>