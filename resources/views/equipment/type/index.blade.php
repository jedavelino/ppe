@extends('layouts.app')

@section('content')
<section class="">
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
								<h3 class="mb-0">Equipment Types</h3>
								<a class="btn btn-outline-primary ml-4" href="{{ route('admin.types.create') }}">Add New</a>
							</div>
							
							<div class="bg-white">
								<table class="w-full">
									<thead>
										<tr>
											<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">ID</th>
											<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Name</th>
											<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Count</th>
											<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Date Added</th>
											<th class="py-2 px-4 font-bold text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($types as $item)
										<tr>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->id }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->name }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->equipments->count() }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">{{ $item->created_at }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-sm">
												<a class="bg-gray-300 font-medium inline-block px-2 py-1 rounded text-gray-800 text-xs" href="{{ route('admin.types.show', $item->id) }}">
													View
												</a>
												<a class="bg-green-300 font-medium inline-block px-2 py-1 rounded text-green-800 text-xs" href="{{ route('admin.types.edit', $item->id) }}">
													Edit
												</a>
												<form class="inline-block" method="POST" action="{{ route('admin.types.destroy', $item->id) }}">
													@csrf
													@method('DELETE')
													<button class="bg-red-300 font-medium inline-block px-2 py-1 rounded text-red-800 text-xs">
														Delete
													</button>
												</form>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							{{ $types->appends(request()->only(['search', 'orderby', 'order']))->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
