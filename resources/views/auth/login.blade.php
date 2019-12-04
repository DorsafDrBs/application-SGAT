@extends('layouts.app')

@section('content')


<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" role="form" method="POST" action="{{ route('login') }}">
				{{ csrf_field() }}
					<span class="login100-form-title p-b-26">
					Bienvenue
					</span>
					<span class="login100-form-title p-b-26">
					<img src="{{ URL::asset('loginadmin/images/Image1.png') }} "style="width=5px;height=5px;" >
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" placeholder="Email"></span>
					</div> @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
								@endif

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" placeholder="Mot de passe"></span>
					</div>@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
							S'identifier
							</button>
						</div>
					</div>
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
					<div class="text-center p-t-115">
						<span class="txt1">
					
						</span>
						@if (Auth::guest())
                   
				   <a href="{{ route('register') }}" class="txt2 text-white">S'inscrire</a>
			   
				  @endif
						
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
