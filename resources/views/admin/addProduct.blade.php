@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a new product</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="text-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="text-success">
                            <ul class="list-unstyled">
                                <li>{{ Session::get('message') }}</li>
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('/add/product') }}" method="POST"  id="fileupload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Product name</label>
                            <input name="name" type="text" class="form-control" placeholder="Product name">
                        </div>
                        <div class="form-group">
                            <label>Product description</label>
                            <textarea name="description" class="form-control" placeholder="Product description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product price</label>
                            <input name="price" type="number" class="form-control" placeholder="Product price" min="0">
                        </div>
                        <div class="form-group">
                            <label>Product price discount (%)</label>
                            <input name="pricediscount" type="number" class="form-control" placeholder="Product price discount (%)" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label>Product quantity</label>
                            <input name="quantity" type="number" class="form-control" placeholder="Product quantity" min="1" >
                        </div>
                        <div class="form-group">
                            <label>Product category</label>
                            <select id="cs" name="category" class="form-control"  style="width: 100%" placeholder="Product category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="form-group">
                            <label>Product subcategory</label>
                            <select name="subcategory" class="form-control" style="width: 100%" placeholder="Product subcategory">
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->subcategory }}">{{ $subcategory->category }} : {{ $subcategory->subcategory }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Product image</label>
                            <input name="image" type="file">
                          </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('js')

@endsection