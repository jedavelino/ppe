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
				
				<div class="d-flex align-items-center justify-content-between">
					<h3>Equipments</h3>
					<a class="btn btn-primary" href="{{ route('admin.equipments.create') }}">Add Equipment</a>
				</div>

				<table class="table table-sm mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
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
							<td>@mdo</td>
						</tr>
						@endforeach
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
@endsection
