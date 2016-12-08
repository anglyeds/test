@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Chains</h2>
	        </div>
	        <div class="pull-right">
	        	@permission('item-create')
	            <a class="btn btn-success" href="{{ route('chains.create') }}"> Create New Item</a>
	            @endpermission
	        </div>
	    </div>
	</div>
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Chain Name</th>
			<th>Display Name</th>
			<th>Description</th>
			<th width="280px">Action</th>
		</tr>
	@foreach ($chains as $key => $chain)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $chain->name }}</td>
		<td>{{ $chain->display_name }}</td>
		<td>{{ $chain->description }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('chains.show',$chain->id) }}">Show</a>
			@permission('item-edit')
			<a class="btn btn-primary" href="{{ route('chains.edit',$chain->id) }}">Edit</a>
			@endpermission
			@permission('item-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['chains.destroy', $chain->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        	@endpermission
		</td>
	</tr>
	@endforeach
	</table>
	{!! $chains->render() !!}
@endsection