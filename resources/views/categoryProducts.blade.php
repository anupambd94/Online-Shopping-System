@extends('layouts.eshopper')

@section('content')  
    <section style=" margin-top: 30px; ">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @if(count($categories) > 0)
                                <?php $i = 1; ?>
                                @foreach($categories as $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading{{ $i }}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapseOne">
                                                    {{ $category->category }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
                                          <div class="panel-body">
                                            <?php $mainCategory = DB::table('subcategories')->where('category',$category->category)->get(); ?>
                                                @foreach($mainCategory as $subcategory)
                                                    <a href="{{ route('subcategoryproducts', [ 'category' => $category->category , 'id' => $subcategory->subcategory]) }}">{{ $subcategory->subcategory }}</a><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++ ?>
                                @endforeach
                            @else 
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="#nocategory">No category found.</a></h4>
                                    </div>
                                </div>
                            @endif
                        </div> 
                        
                
                        
                        <div class="shipping text-center" style=" margin-bottom: 15px; "><!--shipping-->
                            <img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        
                        @if(count($products) > 0)
                            <?php $first = true; ?> 
                            @foreach($products as $productc)
                                @if($first)
                                    <h2 class="title text-center"> {{ $productc->category }} Items</h2> 
                                    <?php $first = false; ?>
                                @endif
                                @foreach($productc->product as $product)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                <?php $imagePath = "images/products/".$product->id.".".$product->imageextension; ?>
                                                    <img src="{{ asset($imagePath) }}" class="img-responsive">
                                                    <h2>${{ $product->price }}</h2>
                                                    <p>{{ $product->name }}</p>
                                                    @if($product->quantity <= 0)
                                                    <a class="btn btn-danger add-to-cart">Out of Stock</a>
                                                @else
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                @endif
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>${{ $product->price }}</h2>
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
