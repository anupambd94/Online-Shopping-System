<header id="header"><!--header-->	
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left header">
							<a href="{{ url('/') }}"><h4><i class="fa fa-lg fa-pagelines"></i> E-COMMERCE</h4></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">								
								<li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart <?php if (Auth::check()) { $cartcount = \DB::table('product_user')
                     ->where('user_id', Auth::user()->id)->get(); if(count($cartcount) > 0) echo count($cartcount);  } ?></a></li>
								@if (Auth::guest())
			                        <li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i>Login</a></li>
			                        <li><a href="{{ url('/register') }}">Register</a></li>
			                    @else
			                    	<li><a href="{{ url('/home') }}"><i class="fa fa-user"></i> Account</a></li>
									<li><a href="{{ url('/order') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
			                        <li class="dropdown">
			                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			                                {{ Auth::user()->name }} <span class="caret"></span>
			                            </a>
			                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
			                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
			                            </ul>
			                        </li>
			                    @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->