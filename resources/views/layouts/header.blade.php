<site-header inline-template>
	<header>
		<nav class="px-10 py-3 flex items-center justify-between shadow">
			<a class="text-xl font-medium inline-block" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>

			<div class="flex items-center flex-1 justify-between ml-10">
				@auth
				<ul class="flex items-center">
					<li class="{{ Route::is('admin.home') ? 'active' : '' }}">
						<a class="text-sm font-medium" href="{{ route('admin.home') }}">Home</a>
					</li>
					<li class="ml-4 {{ strpos(Route::currentRouteName(), 'admin.equipments') === 0 ? 'active' : '' }}">
						<a class="text-sm font-medium" href="{{ route('admin.equipments.index') }}">Equipments</a>
					</li>
				</ul>
				@endauth

				<ul class="flex items-center">
					@guest
						<li>
							<a class="text-sm font-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
							<li class="ml-4">
								<a class="text-sm font-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="relative">
							<a @click.prevent="toggleMenu" class="text-sm font-medium" href="#" role="button">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div :class="{ 'block': showMenu, 'hidden': !showMenu }" class="absolute inset-auto z-40 shadow rounded bg-white py-2 mt-2" aria-labelledby="navbarDropdown">
								<a class="px-3 py-2 text-sm font-medium" href="{{ route('logout') }}"
									onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</nav>
	</header>
</site-header>