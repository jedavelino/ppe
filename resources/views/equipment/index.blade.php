@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="p-4 bg-white shadow-sm">
				@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
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
						<tr>
							<th scope="row">1</th>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>JLarry</td>
							<td>the Bird</td>
							<td>@mdo</td>
						</tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
@endsection
