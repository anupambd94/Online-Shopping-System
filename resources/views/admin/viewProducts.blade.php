@extends('layouts.app')

@section('content')
<div class="container">
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
                    <div class="col-md-5" style="margin-bottom: 30px;">
                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search">
                        </div>
                    @if(count($products) > 0)
                    <table class="table" style=" margin-bottom: 0; ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount (%)</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody  id="myTable">
                        @foreach($products as $product)  
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td style="width: 10%;">
                                        <?php $imagePath = "images/products/".$product->id.".".$product->imageextension; ?>
                                        <img src="{{ asset($imagePath) }}" class="img-responsive">
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        {{ $product->pricediscount }}%
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <td>
                                        {{ $product->category }}
                                    </td>
                                    <td>
                                        {{ $product->subcategory }}
                                    </td>
                                    <td><a href="{{ url('/edit/product', ['id' => $product->id]) }}" class="btn btn-sm btn-default">Edit</a></td>
                                    <td><a href="{{ url('/delete/product', ['id' => $product->id]) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>                                        
                        @endforeach
                        </tbody>  
                    </table>
                    @else
                    <p>No product found</p>
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
</script>
@endsection