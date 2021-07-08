@extends('app')

@section('content')
	<h3>Company settings</h3>
	
	<div class="card">
		<div class="card-header">
			@if ($company)
				Update your company: <strong>{{ $company->name }}</strong>
			@else
				You don't have company yet
			@endif
		</div>
		
		<div class="card-body">
			<company-manage-component company="{{ $company }}" />
		</div>
	</div>
@endsection