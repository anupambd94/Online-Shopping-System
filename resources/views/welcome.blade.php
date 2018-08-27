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
    
    

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row" >
                
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1></h1>
                                    <h2>Free Shipping </h2>
                                    <p>We offer free shipping on all orders. If for some reason your product item doesn't fit, send it back for free.</p>

                                    <!-- <button type="button" class="btn btn-default get">Get it now</button> -->
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/laptop.png') }}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{ asset('images/home/pricing.png') }}"  class="pricing" alt="" /> -->
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1></h1>
                                    <h2>100% original Guarantee</h2>
                                    <p>We confidently guarented that, our every products are 100% orginal.</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/mainboard.png') }}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{ asset('images/home/pricing.png') }}"  class="pricing" alt="" /> -->
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1></h1>
                                    <h2>Life Time Services</h2>
                                    <p> We will provide you better services......Ins Shaa Allah.</p>
                                    <!-- <button type="button" class="btn btn-default get">Get it now</button> -->
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/phone.png') }}" class="girl img-responsive" alt="" />
                                    <!-- <img src="{{ asset('images/home/pricing.png') }}" class="pricing" alt="" /> -->
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    @if (Session::has('message'))
        <section style=" margin-bottom: 15px; margin-top: 15px; ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-success">
                            <ul class="list-unstyled">
                                <li class="text-center">{{ Session::get('message') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                            <?php $imagePath = "images/products/".$product->id.".".$product->imageextension; ?>
                                                <img src="{{ asset($imagePath) }}" width="253px" height="231px">
                                                <h2><?php $dis= ($product->price) - (($product->price) * ($product->pricediscount/100));  ?> TK{{ $dis }} <del>TK{{ $product->price }}</del> </h2>
                                                <p>{{ $product->name }}</p>
                                                @if($product->quantity <= 0)
                                                    <a class="btn btn-danger add-to-cart">Out of Stock</a>
                                                @else
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                @endif
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#model-{{ $product->id }}">
                                                     Details
                                                    </button>
                                                    <h2><?php $dis= ($product->price) - (($product->price) * ($product->pricediscount/100));  ?>TK{{ $dis }} </h2>
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

                                <div class="modal fade" id="model-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{ $product->name }}</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>{{ $product->description }}</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12">
                            <h4 class="text-center text-warning">No product item.</h4>
                            </div>
                        @endif                      
                    </div><!--features_items-->                
                </div>
            </div>
        </div>
    </section>
    
    
@endsection
