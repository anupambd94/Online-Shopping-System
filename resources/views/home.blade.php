@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(count($order) > 0)
                    <div class="row">
                            <div class="col-xs-12">
                                <h4 class="text-center">Total spend</h4>
                                <h1 class="text-center">
                                    <?php $total = 0; ?>
                                    @foreach($order as $o)
                                        <?php 
                                        $products = \DB::table('products')->where('id', $o->product_id)->first();
                                         $total = $total + $products->price * $o->quantity;
                                        ?>
                                    @endforeach
                                    {{ $total }} Taka
                                </h1>
                            </div>
                        </div> 
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
