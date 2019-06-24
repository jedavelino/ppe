@extends('layouts.app')

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
					<a class="btn btn-outline-primary ml-4" href="{{ route('admin.equipments.create') }}">Add New</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
