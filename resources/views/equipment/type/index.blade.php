@extends('layouts.app')

{{-- {{ dump($types) }} --}}

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
					<h3 class="mb-0">Equipment Types</h3>
					<a class="btn btn-outline-primary ml-4" href="{{ route('admin.types.create') }}">Add New</a>
				</div>

				<table class="table table-sm mt-3">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Count</th>
							<th scope="col">Date Added</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($types as $item)
						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td>{{ $item->name }}</td>
							<td>{{ $item->equipments->count() }}</td>
							<td>{{ $item->created_at }}</td>
							<td>
								<a class="btn btn-sm btn-secondary" href="{{ route('admin.types.show', $item->id) }}">
									View
								</a>
								<a class="btn btn-sm btn-success" href="{{ route('admin.types.edit', $item->id) }}">
									Edit
								</a>
								<form class="d-inline-block" method="POST" action="{{ route('admin.types.destroy', $item->id) }}">
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

				{{ $types->appends(request()->only(['search', 'orderby', 'order']))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
