<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
<div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand " href="{{ url('/') }}">
    LBBS
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">
    	<li class="nav-item @if (Route::is('topics.index')) active @endif "><a href="{{ route('topics.index') }}" class="nav-link">话题</a></li>
    	@foreach ($categories as $category)
    		<li class="nav-item @if (Route::is('categories.show') && Route::input('category')->is($category)) active @endif"><a href="{{ route('categories.show', $category->id) }}" class="nav-link">{{ $category->name }}</a></li>
    	@endforeach
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav navbar-right">
        <!-- Authentication Links -->
        @guest
        	<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
        	<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
        @else
			<li class="nav-item">
				<a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
					<i class="fa fa-plus"></i>
				</a>
			</li>
	        <li class="nav-item dropdown">
	            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            <img src="{{ Auth::user()->avatar }}" width="30px" height="30px">
	            {{ Auth::user()->name }}
	            </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">
	            	<i class="far fa-user mr-2"></i>
	            	个人中心
	            </a>
	            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
	            	<i class="far fa-edit mr-2"></i>
	            	编辑资料
	        	</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" id="logout" href="#">
	                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('确定是否退出？');">
	                {{ csrf_field() }}
	                <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
	                </form>
	            </a>
	            </div>
	        </li>
        @endguest
    </ul>
    </div>
</div>
</nav>