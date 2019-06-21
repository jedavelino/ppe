@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-4 bg-white shadow-sm">
				<div class="d-flex align-items-center justify-content-between">
					<h3>{{ $equipment->name }}</h3>
				</div>

				<div class="mt-4">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="name">Name:</label>
						<div class="col-sm-10">
							<input readonly type="text" class="form-control-plaintext" id="name" name="name" value="{{ $equipment->name }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="description">Description:</label>
						<div class="col-sm-10">
							<textarea readonly class="form-control-plaintext" id="description" name="description" rows="4">{{ $equipment->description }}</textarea>
						</div>
					</div>
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
