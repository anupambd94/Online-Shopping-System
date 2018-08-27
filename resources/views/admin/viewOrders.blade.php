@extends('layouts.app')

@section('content')  

<div class="container" style=" margin-top: 30px; ">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Checkout Cart</h5>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="panel-body">    
                        @if(count($order) > 0)
                            <table class="table" style=" margin-bottom: 0; ">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>User Name</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $o)
                                    <?php 
                                    $products = \DB::table('products')->where('id', $o->product_id)->first();
                                    $user = \DB::table('users')->where('id', $o->user_id)->first();
                                    ?>
                                        <tr>
                                            <td>{{ $o->product_id }}</td>
                                            <td>{{ $user->name }}</td>
                                            

                                            <td style="width: 5%">
                                            <?php $imagePath = "images/products/".$products->id.".".$products->imageextension; ?>
                                                    <img src="{{ asset($imagePath) }}" class="img-responsive">
                                            </td>
                                            <td>{{ $products->name }}</td>
                                            <td>{{ $user->mobile ? $user->mobile: 'admin'  }}</td>
                                            <td>{{ $user->address ? $user->address: 'admin' }}</td>
                                            <td> <?php $dis= ($products->price) - (($products->price) * ($products->pricediscount/100));  ?> {{ $dis }}</td>
                                            <td>{{ $o->quantity }}</td>
                                            <td>{{ $dis * $o->quantity }}</td>
                                            <td>{{ $o->created_at->format('d M Y')  }}</td>
                                            <td>{{ $o->created_at->format('h:i A')  }}</td>
                                            <td>@if($o->active != 1) <a href="{{ route('order-active', ['id' => $o->id]) }}">Active</a>@else Complite @endif</td>
                                        </tr>                                   
                                    @endforeach
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
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
