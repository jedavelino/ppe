@extends('layouts.app')

@section('content')
<div class="container">
	<div class="w-full max-w-xs mx-auto">
			<div class="text-xl font-medium">{{ __('Login') }}</div>
			<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mt-4" method="POST" action="{{ route('login') }}">
					@csrf

					<div class="">
							<label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>
							<input id="email" type="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
									<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
									</span>
							@enderror
					</div>

					<div class="mt-4">
							<label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
							<input id="password" type="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							@error('password')
									<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
									</span>
							@enderror
					</div>

					<div class="flex items-center mt-4">
							<label class="md:w-2/3 block text-gray-700 text-sm font-bold" for="remember">
									<input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<span class="text-sm">{{ __('Remember Me') }}</span>
							</label>
					</div>

					<div class="flex items-center justify-between mt-4">
						<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
								{{ __('Login') }}
						</button>

						@if (Route::has('password.request'))
							<a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
							</a>
						@endif
					</div>
			</form>
	</div>
</div>
@endsection
