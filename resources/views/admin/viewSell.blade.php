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
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Sell List</h5>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="panel-body">    
                        <div class="col-md-5" style="margin-bottom: 30px;">
                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search">
                        </div>
                        @if(count($order) > 0)
                            <table class="table" style=" margin-bottom: 0; " >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>User Name</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($order as $o)
                                    <?php 
                                    $products = \DB::table('products')->where('id', $o->product_id)->first();
                                    $user = \DB::table('users')->where('id', $o->user_id)->first();
                                    ?>
                                        <tr>
                                            <td>{{ $o->updated_at->format('d M Y')  }}</td>
                                            <td>{{ $o->updated_at->format('h:i A')  }}</td>
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
                                            <td id="checkcombat" class="combat">{{ $dis * $o->quantity }}</td>
                                            
                                        </tr>                                   
                                    @endforeach
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td class="total"></td>
                                    </tr>
                                </tbody>
                            </table>                            
                        @else                   
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="text-center">
                                        No sell product available.
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

@section('js')
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
$("body").click(function(){
        var sum = 0;
         $('tr:visible').each(function () {         
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
</script>
@endsection