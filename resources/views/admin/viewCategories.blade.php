@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style="width: 48%; float: left; ">
                <div class="panel-heading">Categories</div>

                <div class="panel-body">
                    <ul class="list-unstyled">
                        @foreach($categories as $category)                        
                            <li>
                                <table class="table" style=" margin-bottom: 0; ">
                                    <tr>
                                        <td style="width: 68%;">{{ $category->category }}</td>
                                        <td><a href="{{ url('/edit/category', ['id' => $category->id]) }}" class="btn btn-sm btn-default">Edit</a></td>
                                        <td><a href="{{ url('/delete/category', ['id' => $category->id]) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                    </tr>
                                </table>
                            </li>                        
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel panel-default" style="width: 48%; float: right; ">
                <div class="panel-heading">Subcategories</div>

                <div class="panel-body">
                    <ul class="list-unstyled">
                        @foreach($subcategories as $subcategory)                       
                            <li>
                                <table class="table" style=" margin-bottom: 0; ">
                                    <tr>
                                        <td style="width: 34%;">{{ $subcategory->category }}</td>
                                        <td style="width: 34%;">{{ $subcategory->subcategory }}</td>
                                        <td><a href="{{ url('/edit/subcategory', ['id' => $subcategory->id]) }}" class="btn btn-sm btn-default">Edit</a></td>
                                        <td><a href="{{ url('/delete/subcategory', ['id' => $subcategory->id]) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                    </tr>
                                </table>
                            </li>                        
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
