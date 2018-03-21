 @extends('layout.index')
 @section('content')
 <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            	@if(Auth::check())
	                <div class="panel panel-default">
					  	<div class="panel-heading">Thông tin tài khoản</div>
					  	<div class="panel-body">
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
					    	<form action="thong-tin-tai-khoan" method="POST">
					    		<input type="hidden" name="_token" value="{{csrf_token()}}">
					    		<div>
					    			<label>Họ tên</label>
								  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$user->name}}">
								</div>
								<br>
								<div>
					    			<label>Email</label>
								  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
								  	disabled value="{{$user->email}}" 
								  	>
								</div>
								<br>	
								<div>
									<input type="checkbox" class="" name="checkpassword">
					    			<label>Đổi mật khẩu</label>
								  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
								</div>
								<br>
								<div>
					    			<label>Nhập lại mật khẩu</label>
								  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
								</div>
								<br>
								<button type="submit" class="btn btn-default">Sửa
								</button>

					    	</form>
					  	</div>
					</div>
				@endif
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection