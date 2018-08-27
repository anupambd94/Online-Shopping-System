@extends('layouts.eshopper')

@section('content')  

<div ng-app="eShopper" ng-controller="eShopperController" class="container" style=" margin-top: 30px; ">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">View products</div>

				
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
                    <form id="formsubmit" action="{{ url('/add/order') }}" method="POST">
                    	{{ csrf_field() }}
						
						@if(count($viewcart) > 0)	
							<table class="table" style=" margin-bottom: 0; ">
		                        <thead>
		                            <tr>
		                                <th ng->ID</th>
		                                <th>Image</th>
		                                <th>Name</th>
		                                <th>Price</th>
		                                <th>Quantity</th>
		                                <th>Total Price</th>
		                                <th>Total Doller</th>
		                                <th>Delete</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php $i = 1; ?>
		                        @foreach($viewcart as $carts)
		                        <?php $dis= ($carts->price) - (($carts->price) * ($carts->pricediscount/100));  ?>
		                        	<input type="hidden" name="product_id[{{ $i }}]" value="{{ $carts->id }}">
		                        	<input ng-model="price{{ $i }}" type="number" value="{{ $dis }}" name="price[{{ $i }}]" hidden>
			                        
			                        	<tr>
			                        		<td>{{ $carts->id }}</td>
			                        		<td style="width: 10%;"><?php $imagePath = "images/products/".$carts->id.".".$carts->imageextension; ?>
	                                                <img src="{{ asset($imagePath) }}" class="img-responsive"></td>
			                        		<td>{{ $carts->name }}</td>
			                        		<td>{{ $dis }}
			                        		</td>
			                        		<td style="width: 8%;">
			                        			<input id="qu" ng-model="quantity{{ $i }}" type="number" name="quantity[{{ $i }}]" class="form-control input-sm" value="1" placeholder="1" min="0" max="{{ $carts->quantity }}">
			                        		</td>
			                        		<td class="combat">[{ getTotal(price{{ $i }},quantity{{ $i }}) }]</td>
			                        		<td>$[{ getTotal(price{{ $i }},quantity{{ $i }})/80 }]</td>
			                        		<td><a href="{{ url('/delete/cart', ['id' => $carts->id ]) }}" class="btn btn-sm btn-danger">Delete</a></td>
			                        	</tr>
			                       
			                        <?php $i++ ?>
		                        @endforeach
		                        <tr>
		                        	<td></td>
		                        	<td></td>
		                        	<td></td>
		                        	<td></td>
		                        	<td>Total</td>
		                        	<td class="total"></td>
		                        	
		                        	<td class="dtotal"></td>
		                        	<td></td>
		                        </tr>
		                         </tbody>
	                        </table>				
						@else
							<div class="row">
								<div class="col-xs-12">
									<h4 class="text-center">
										No cart available.
									</h4>
								</div>
							</div>
						@endif
						<button class="btn btn-success" type="submit">Checkout</button>
						
					</form>
										
				</div>
				
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
@endsection

@section('scriptlink')
    var app = angular.module('eShopper', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('[{');
        $interpolateProvider.endSymbol('}]');
    });

    app.controller("eShopperController", function ($scope) {
        @if(count($viewcart) > 0)
        	<?php $i = 1; ?>
		    @foreach($viewcart as $carts)
		    	$scope.price{{ $i }} = <?php $dis= ($carts->price) - (($carts->price) * ($carts->pricediscount/100));  ?> {{ $dis }};
		    	$scope.quantity{{ $i }} = 0;
		    <?php $i++ ?>
		    @endforeach
        @endif

        $scope.getTotal = function(price,quantity) {
		  return price * quantity;
		 }
    });
    $("body").click(function(){
		var sum = 0;
	     $('tr').each(function () {         
		     $(this).find('.combat').each(function () {
		         var combat = $(this).text();
		         if (!isNaN(combat) && combat.length !== 0) {
		             sum += parseFloat(combat);
		         }
		     });	     
	     });
		console.log(sum);
		$('.total').html(sum);
		$('.dtotal').html(sum/80);
	});
@endsection