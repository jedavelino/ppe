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
				
				<div class="d-flex align-items-center hidden">
					<h3 class="mb-0">Equipments</h3>
					<div class="btn-group ml-4" role="group">
						<button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New</button>
						<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							<a class="dropdown-item" href="{{ route('admin.equipments.create') }}">Equipment</a>
							<a class="dropdown-item" href="{{ route('admin.types.create') }}">Type</a>
						</div>
					</div>
				</div>

				<div class="mt-4 d-flex align-items-center justify-content-between hidden">
					<div class="d-flex">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link active" href="{{ route('admin.equipments.index') }}">All</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " href="{{ route('admin.equipments.index', ['status' => 'trashed']) }}">Trash</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " href="{{ route('admin.types.index') }}">Types</a>
							</li>
						</ul>
					</div>
					<form class="form-inline" method="GET" action={{ route('admin.equipments.index', [
						'search' => request()->search,
						'status' => 'trashed',
					]) }}>
						<div class="form-group">
							<label for="search" class="sr-only">Search</label>
							<input type="search" class="form-control form-control-sm" id="search" name="search" value="{{ old('search') }}" placeholder="Search...">
						</div>
						@if (old('status'))
						<input type="hidden" name="status" value="{{ old('status') }}">
						@endif
						<button type="submit" class="btn btn-sm btn-outline-dark ml-2">Search</button>
					</form>
				</div>

				<div class="d-flex align-items-center justify-content-between mt-2 hidden">
					<form class="form-inline" method="GET" action="{{ route('admin.equipments.index', [
						'orderby' => request()->orderby,
						'order' => request()->order,
						'search' => request()->search,
						'status' => 'trashed',
					]) }}">
						<div class="form-group">
							<label class="mr-2 sr-only" for="orderby">Order by</label>
							<select class="custom-select custom-select-sm" id="orderby" name="orderby">
								<option disabled selected>Select</option>
								<option {{ request()->orderby === 'name' ? 'selected' : '' }} value="name">Name</option>
								<option {{ request()->orderby === 'created_at' ? 'selected' : '' }} value="created_at">Date</option>
							</select>
						</div>
						<div class="form-group ml-2">
							<label class="mr-2 sr-only" for="order">Order</label>
							<select class="custom-select custom-select-sm" id="order" name="order">
								<option disabled selected>Select</option>
								<option {{ request()->order === 'asc' ? 'selected' : '' }} value="asc">ASC</option>
								<option {{ request()->order === 'desc' ? 'selected' : '' }} value="desc">DESC</option>
							</select>
						</div>
						@if (old('search'))
						<input type="hidden" name="search" value="{{ old('search') }}">
						@endif
						@if (old('status'))
						<input type="hidden" name="status" value="{{ old('status') }}">
						@endif
						<button type="submit" class="btn btn-sm btn-outline-secondary ml-2">Order</button>
					</form>
					<div>
						Showing {{ _countPerPageTotal($equipments) }} out of {{ $equipments->total() }}
					</div>
				</div>

				<table class="w-full">
					<thead class="bg-gray-200">
						<tr>
							<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left" scope="col">ID</th>
							<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left" scope="col">Name</th>
							<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left" scope="col">Type</th>
							<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left" scope="col">Date Added</th>
							<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left" scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($equipments as $item)
						<tr>
							<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->id }}</td>
							<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->name }}</td>
							<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->type ? $item->type->name : null }}</td>
							<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->created_at }}</td>
							<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">
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

				{{ $equipments->appends(request()->only(['search', 'orderby', 'order', 'status']))->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
