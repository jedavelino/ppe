@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-4 bg-white shadow-sm">

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				
				<div class="d-flex align-items-center justify-content-between">
					<h3>Edit Equipment</h3>
				</div>

				<form method="POST" action="{{ route('admin.equipments.update', $equipment->id) }}" class="mt-4">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="name">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{ $equipment->name }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="description">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" rows="4">{{ $equipment->description }}</textarea>
						</div>
					</div>
					<div class="form-group d-flex justify-content-end">
						<a href="{{ url()->previous() }}" class="btn btn-secondary">
							Cancel
						</a>
						<button class="btn btn-primary ml-2" type="submit">
							Update
						</button>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection
