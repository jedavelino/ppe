@extends('layouts.app')

{{-- {{ dump($equipments) }} --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="p-4 bg-white shadow-sm">
				@if (session('status'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ session('status') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				
				<div class="d-flex align-items-center">
					<h3 class="mb-0">Equipments</h3>
					{{-- <a class="btn btn-outline-primary ml-4" href="{{ route('admin.equipments.create') }}">Add New</a> --}}
					<div class="btn-group ml-4" role="group">
						<button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New</button>
						<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							<a class="dropdown-item" href="{{ route('admin.equipments.create') }}">Equipment</a>
							<a class="dropdown-item" href="{{ route('admin.types.create') }}">Type</a>
						</div>
					</div>
				</div>

				<div class="mt-4 d-flex align-items-center justify-content-between">
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

				<div class="d-flex align-items-center justify-content-between mt-2">
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

				<table class="table table-sm mt-3">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Type</th>
							<th scope="col">Date Added</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($equipments as $item)
						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td>{{ $item->name }}</td>
							<td>{{ $item->type->name }}</td>
							<td>{{ $item->created_at }}</td>
							<td>
								@if (old('status') === 'trashed')
								<form class="d-inline-block" method="POST" action="{{ route('admin.equipments.restore', $item->id) }}">
									@csrf
									<button class="btn btn-sm btn-secondary">
										Restore
									</button>
								</form>
								<form class="d-inline-block" method="POST" action="{{ route('admin.equipments.destroy', $item->id) }}">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-danger">
										Delete
									</button>
								</form>
								@else
								<a class="btn btn-sm btn-secondary" href="{{ route('admin.equipments.show', $item->id) }}">
									View
								</a>
								<a class="btn btn-sm btn-success" href="{{ route('admin.equipments.edit', $item->id) }}">
									Edit
								</a>
								<form class="d-inline-block" method="POST" action="{{ route('admin.equipments.trash', $item->id) }}">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-danger">
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
</div>
@endsection
