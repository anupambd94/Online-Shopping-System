@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit a subcategory</div>

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
                    <form action="{{ url('/edit/subcategory', ['id' => $subcategory->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Edit Subcategory</label>
                            <input name="subcategory" type="text" class="form-control" placeholder="Edit Subcategory" value="{{ $subcategory->subcategory }}">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
