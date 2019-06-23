@extends('layouts.app')

{{-- {{ dd($equipments) }} --}}

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
				</div>

				<div class="mt-4 d-flex align-items-center justify-content-between">
					<div class="d-flex">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link active" href="{{ route('admin.equipments.index') }}">All</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " href="{{ route('admin.equipments.trashed') }}">Trash</a>
							</li>
						</ul>
					</div>
					<form class="form-inline" method="GET" action="{{ route('admin.equipments.trashed', request()->search) }}">
						<div class="form-group">
							<label for="search" class="sr-only">Search</label>
							<input type="search" class="form-control form-control-sm" id="search" name="search" value="{{ old('search') }}" placeholder="Search...">
						</div>
						<button type="submit" class="btn btn-sm btn-outline-dark ml-2">Search</button>
					</form>
				</div>

				<div class="d-flex align-items-center justify-content-between mt-2">
					<form class="form-inline" method="GET" action="{{ route('admin.equipments.trashed', [
						'order' => request()->order,
						'search' => request()->search,
					]) }}">
						<label class="mr-2 sr-only" for="order">Order by</label>
						<select class="custom-select custom-select-sm" id="order" name="order">
							<option disabled selected>Select</option>
							<option {{ request()->order === 'name' ? 'selected' : '' }} value="name">Name</option>
							<option {{ request()->order === 'id' ? 'selected' : '' }} value="id">ID</option>
						</select>
						<input type="hidden" name="search" value="{{ old('search') }}">
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
							<th scope="col">Description</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($equipments as $item)
						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td>{{ $item->name }}</td>
							<td>{{ $item->description }}</td>
							<td>
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
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{{ $equipments->appends(request()->only(['search', 'order']))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
