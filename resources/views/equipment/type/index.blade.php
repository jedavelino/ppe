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
				
							<div class="flex items-center justify-between">
								<h3 class="font-medium text-2xl text-gray-800">Equipment Types</h3>
								<a class="bg-blue-200 border border-blue-300 font-medium leading-snug px-4 py-2 rounded text-blue-700 text-sm" href="{{ route('admin.types.create') }}">Add New</a>
							</div>
							
							<div class="bg-white shadow rounded mt-6">
								<table class="w-full">
									<thead>
										<tr>
											<th class="py-2 px-4 font-bold border-t text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">ID</th>
											<th class="py-2 px-4 font-bold border-t text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Name</th>
											<th class="py-2 px-4 font-bold border-t text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Count</th>
											<th class="py-2 px-4 font-bold border-t text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Date Added</th>
											<th class="py-2 px-4 font-bold border-t text-xs text-gray-700 uppercase text-left bg-gray-200" scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($types as $item)
										<tr>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->id }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->name }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->equipments->count() }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">{{ $item->created_at }}</td>
											<td class="py-2 px-4 text-gray-800 border-t font-medium text-xs">
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
