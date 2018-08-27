@extends('layouts.eshopper')

@section('content')  

<div  class="container" style=" margin-top: 30px; ">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Payment</div>

				
				<div class="panel-body">
                    <style type="text/css">
                        .table tbody tr td {
                            vertical-align: middle;
                        }
                    </style>
                    @if (Session::has('message'))
                        <div class="text-success">
                            <ul class="list-unstyled">
                                <li>{{ Session::get('message') }}</li>
                            </ul>
                        </div>
                    @endif			
				</div>
				
			</div>
		</div>
	</div>
</div>

@endsection
