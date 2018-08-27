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
                    <form action="{{ url('/cart') }}" method="POST">
                    {{ csrf_field() }}
                    	<input type="number" name="total" value="{{ intval(($total/80) * 100) }}" hidden>
						<script
								    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								    data-key="pk_test_nnQ0mOeQUJU0TbTyDu0erPbM"
								    data-amount="{{ intval(($total/80) * 100) }}"
								    data-name="eCommerce"
								    data-description="Products checkout."
								    data-image="{{ asset('images/home/logo2.png') }}"
								    data-locale="auto">
								  </script>
					</form>					
				</div>
				<div class="col-md-12" style="margin-top: 30px">
						<img src="{{ asset('images/payment/all.png') }}" height="160"> 
					</div>
			</div>
		</div>
	</div>
</div>

@endsection
