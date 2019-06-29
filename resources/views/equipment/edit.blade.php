@extends('layouts.app')

@section('content')
<section>
    <div class="container flex justify-center">
				<div class="w-2/3">
					@if ($errors->any())
						<div class="bg-red-200 border border-red-300 font-medium mb-6 px-4 py-3 rounded text-red-700 text-sm">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<h3 class="font-medium text-2xl text-gray-800">Edit {{ $equipment->name }}</h3>
					
					<div class="p-4 bg-white shadow rounded mt-6">
						<form method="POST" action="{{ route('admin.equipments.update', $equipment->id) }}" class="mt-4">
							@csrf
							@method('PUT')

							<div class="flex flex-wrap -mx-4 -mt-4">
								<div class="w-1/2 px-4 mt-4">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Name</label>
									<input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" name="name" value="{{ $equipment->name }}">
									@error('name')
										<span class="text-xs text-red-500">{{ $message }}</span>
									@enderror
								</div>
								<div class="w-1/2 px-4 mt-4">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="type">Type</label>
									<div class="relative">
										<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="type_id" id="type">
											@foreach ($types as $option)
											@if ($equipment->type)
											<option value="{{ $option->id }}" {{ $option->id === $equipment->type->id ? 'selected' : '' }}>{{ $option->name }}</option>
											@else
											<option value="{{ $option->id }}">{{ $option->name }}</option>
											@endif
											@endforeach
										</select>
										<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
												<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
										</div>
									</div>
								</div>
								<div class="w-1/2 px-4 mt-4">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">Description</label>
									<textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" name="description" rows="4">{{ $equipment->description }}</textarea>
								</div>
							</div>
							<div class="mt-4 flex items-center">
								<button class="bg-blue-200 font-medium leading-snug px-4 py-2 rounded text-blue-700 text-sm" type="submit">
									Update
								</button>
								<a href="{{ route('admin.equipments.index') }}" class="ml-4 bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded text-sm leading-snug inline-block">
									Cancel
								</a>
							</div>
						</form>
					</div>
				</div>
    </div>
	</section>
@endsection
