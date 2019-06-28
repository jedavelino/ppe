@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
				<div class="d-flex align-items-center justify-content-between">
					<h3>{{ $equipment->name }}</h3>
				</div>

				<div class="bg-white shadow rounded p-4">
					{{-- <div class="flex">
						<div class="w-1/3">Name:</div>
						<div class="w-2/3">
							<p>{{ $equipment->name }}</p>
						</div>
					</div> --}}
					<div class="flex">
						<div class="w-1/3">Type:</div>
						<div class="w-2/3">
							<p>{{ $equipment->type ? $equipment->type->name : null }}</p>
						</div>
					</div>
					<div class="flex">
						<div class="w-1/3">Description:</div>
						<div class="w-1/2">
							{{ $equipment->description }}
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
@endsection
