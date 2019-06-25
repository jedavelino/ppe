@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-4 bg-white shadow-sm">
				<div class="d-flex align-items-center justify-content-between">
					<h3>{{ $type->name }}</h3>
				</div>

				<div class="mt-4">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="description">Description:</label>
						<div class="col-sm-10">
							<textarea readonly class="form-control-plaintext" id="description" name="description" rows="4">{{ $type->description }}</textarea>
						</div>
					</div>
					
					<table class="table table-bordered table-sm mt-3">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col">Date Added</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($type->equipments as $item)
							<tr>
								<th scope="row">{{ $item->id }}</th>
								<td>{{ $item->name }}</td>
								<td>{{ $item->created_at }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="form-group d-flex justify-content-end">
						<a href="{{ url()->previous() }}" class="btn btn-secondary">
							Back
						</a>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
