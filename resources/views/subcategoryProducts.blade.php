@extends('layouts.eshopper')

@section('content')  
     <nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(count($categories) > 0)
        <?php $i = 1; ?>
            @foreach($categories as $category)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ $category->category }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">                         
                        <?php $mainCategory = DB::table('subcategories')->where('category',$category->category)->get(); ?>
                        @foreach($mainCategory as $subcategory)
                            <li><a href="{{ route('subcategoryproducts', [ 'category' => $category->category , 'id' => $subcategory->subcategory]) }}">{{ $subcategory->subcategory }}</a></li>
                        @endforeach
                    </ul>
                </li>
        <?php $i++; ?>
            @endforeach
        @endif
        
      </ul>
      <form class="navbar-form navbar-right" method="GET" action="{{ url('search') }}">
        <div class="form-group">
          <input type="text" class="form-control" name="keyword" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-success">Go!</button>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 
    <section style=" margin-top: 50px; ">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="features_items"><!--features_items-->
                        
                        @if(count($products) > 0)
                            <?php $first = true; ?> 
                            @foreach($products as $product)
                                @if($first)
                                    <h2 class="title fd text-center">{{ $product->category }} / {{ $product->subcategory }}</h2> 
                                    <?php $first = false; ?>
                                @endif
                                
                                    <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                            <?php $imagePath = "images/products/".$product->id.".".$product->imageextension; ?>
                                                <img src="{{ asset($imagePath) }}" width="253px" height="231px">
                                                <h2><?php $dis= ($product->price) - (($product->price) * ($product->pricediscount/100));  ?> ${{ $dis }} <del>${{ $product->price }}</del> </h2>
                                                <p>{{ $product->name }}</p>
                                                @if($product->quantity <= 0)
                                                    <a class="btn btn-danger add-to-cart">Out of Stock</a>
                                                @else
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                @endif
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2><?php $dis= ($product->price) - (($product->price) * ($product->pricediscount/100));  ?>${{ $dis }} </h2>
                                                    <p>{{ $product->name }}</p>
                                                    @if($product->quantity <= 0)
                                                        <a class="btn btn-danger add-to-cart">Out of Stock</a>
                                                    @else
                                                    <a href="{{ url('/add/cart', ['id' => $product->id ]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                        @else
                            <div class="col-sm-12" style="height: 300px;">
                            <h4 class="text-center" >Sorry we don't have any product.</h4>
                            </div>
                        @endif                      
                    </div><!--features_items-->               
                </div>
            </div>
        </div>
    </section>
    
   
@endsection
