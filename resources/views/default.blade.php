@extends('app')

@section('content')
	
	@guest
		<h3>You shall not pass</h3>
	@endguest
	@auth
		<h3>Fly, you fools!</h3>
	@endauth
@endsection