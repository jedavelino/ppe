@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="">
            <div class="">
				@if (session('status'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ session('status') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				
				<div class="flex items-center justify-between">
					<h3 class="font-medium text-2xl text-gray-800">Equipments</h3>
					<a class="bg-blue-200 border border-blue-300 font-medium leading-snug px-4 py-2 rounded text-blue-700 text-sm" href="{{ route('admin.equipments.create') }}">Add New</a>
				</div>

				<div class="hidden">
					Showing {{ _countPerPageTotal($equipments) }} out of {{ $equipments->total() }}
				</div>
				
				<div class="bg-white shadow rounded mt-6">
					<div class="px-4">
						<div class="flex items-center justify-between border-b">
							<div class="flex items-center">
								<a class="text-sm px-4 py-4 border-gray-500 -mb-px {{ request()->status !== 'trashed' ? 'font-bold border-b' : '' }}" href="{{ route('admin.equipments.index') }}">All</a>
								<a class="text-sm px-4 py-4 border-gray-500 -mb-px {{ request()->status === 'trashed' ? 'font-bold border-b' : '' }}" href="{{ route('admin.equipments.index', ['status' => 'trashed']) }}">Trash</a>
							</div>
							<span class="inline-block text-xs text-gray-700 font-medium">
								Showing {{ _countPerPageTotal($equipments) }} out of {{ $equipments->total() }}
							</span>
						</div>
					</div>
					<div class="flex items-center justify-between px-4 py-4">
						<div class="flex items-center">
							<form class="flex items-center" method="GET" action="{{ route('admin.equipments.index', [
								'orderby' => request()->orderby,
								'order' => request()->order,
								'search' => request()->search,
								'status' => 'trashed',
							]) }}">
								<div class="flex items-center ">
									<div class="relative">
										<select class="block text-xs font-medium appearance-none w-full bg-gray-100 border border-gray-200 rounded text-gray-600 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="orderby" name="orderby">
											<option {{ request()->orderby === 'name' ? 'selected' : '' }} value="name" selected>Name</option>
											<option {{ request()->orderby === 'created_at' ? 'selected' : '' }} value="created_at">Date</option>
										</select>
										<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
												<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
										</div>
									</div>
								</div>
								@if (old('search'))
								<input type="hidden" name="search" value="{{ old('search') }}">
								@endif
								@if (old('status'))
								<input type="hidden" name="status" value="{{ old('status') }}">
								@endif
								<button type="submit" class="ml-1 bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded text-xs leading-snug">Order</button>
							</form>

							<form class="flex items-center ml-4" method="GET" action="{{ route('admin.equipments.index', [
								'orderby' => request()->orderby,
								'order' => request()->order,
								'search' => request()->search,
								'status' => 'trashed',
							]) }}">
								<div class="flex items-center ">
									<div class="relative">
										<select class="block text-xs font-medium appearance-none w-full bg-gray-100 border border-gray-200 rounded text-gray-600 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="orderby" name="orderby">
											<option {{ request()->orderby === 'name' ? 'selected' : '' }} value="name" selected>All Types</option>
											<option {{ request()->orderby === 'created_at' ? 'selected' : '' }} value="created_at">Diabetes</option>
										</select>
										<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
												<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
										</div>
									</div>
								</div>
								<div class="flex items-center ml-1">
									<div class="relative">
										<select class="block text-xs font-medium appearance-none w-full bg-gray-100 border border-gray-200 rounded text-gray-600 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="orderby" name="orderby">
											<option {{ request()->orderby === 'name' ? 'selected' : '' }} value="name" selected>All Locations</option>
											<option {{ request()->orderby === 'created_at' ? 'selected' : '' }} value="created_at">Diabetes</option>
										</select>
										<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
												<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
										</div>
									</div>
								</div>
								@if (old('search'))
								<input type="hidden" name="search" value="{{ old('search') }}">
								@endif
								@if (old('status'))
								<input type="hidden" name="status" value="{{ old('status') }}">
								@endif
								<button type="submit" class="ml-1 bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded text-xs leading-snug">Filter</button>
							</form>
						</div>

						<form class="flex items-center" method="GET" action={{ route('admin.equipments.index', [
							'search' => request()->search,
							'status' => 'trashed',
						]) }}>
							<div class="form-group">
								<input type="search" class="appearance-none block w-full bg-gray-100 text-xs border border-gray-200 rounded py-2 px-4 font-medium leading-tight focus:outline-none focus:border-gray-500 focus:bg-white" id="search" name="search" value="{{ old('search') }}" placeholder="Search...">
							</div>
							@if (old('status'))
							<input type="hidden" name="status" value="{{ old('status') }}">
							@endif
							<button type="submit" class="ml-1 bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded text-xs leading-snug">Search</button>
						</form>
					</div>
					<table class="w-full">
						<thead>
							<tr>
								<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">ID</th>
								<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Name</th>
								<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Type</th>
								<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Date Added</th>
								<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($equipments as $item)
							<tr>
								<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->id }}</td>
								<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->name }}</td>
								<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->type ? $item->type->name : null }}</td>
								<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->created_at }}</td>
								<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">
									@if (old('status') === 'trashed')
									<form class="inline-block" method="POST" action="{{ route('admin.equipments.restore', $item->id) }}">
										@csrf
										<button class="bg-gray-300 font-medium inline-block px-2 py-1 rounded text-gray-800 text-xs">
											Restore
										</button>
									</form>
									<form class="inline-block" method="POST" action="{{ route('admin.equipments.destroy', $item->id) }}">
										@csrf
										@method('DELETE')
										<button class="bg-red-400 font-medium inline-block px-2 py-1 rounded text-white text-xs">
											Delete
										</button>
									</form>
									@else
									<a class="bg-gray-300 font-medium inline-block px-2 py-1 rounded text-gray-800 text-xs" href="{{ route('admin.equipments.show', $item->id) }}">
										View
									</a>
									<a class="bg-green-300 font-medium inline-block px-2 py-1 rounded text-green-800 text-xs" href="{{ route('admin.equipments.edit', $item->id) }}">
										Edit
									</a>
									<form class="inline-block" method="POST" action="{{ route('admin.equipments.trash', $item->id) }}">
										@csrf
										@method('DELETE')
										<button class="bg-red-300 font-medium inline-block px-2 py-1 rounded text-red-800 text-xs">
											Trash
										</button>
									</form>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{ $equipments->appends(request()->only(['search', 'orderby', 'order', 'status']))->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
