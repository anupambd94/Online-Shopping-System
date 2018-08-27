@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All notification</div>

                <div class="panel-body">    
                        @if(count($notification) > 0)
                            <table class="table" style=" margin-bottom: 0; ">
                                <thead>
                                    <tr>
                                        <th>Message</th>
                                        <th>Time</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notification as $c)
                                        <tr>
                                            <td>{{ $c->message }}</td>
                                            <td>{{ $c->created_at->format('d M Y h:i A')  }}</td>
                                            <td><a href="{{ url('/delete/notification', ['id'=> $c->id]) }}" class="btn btn-danger">Delete</a></td>
                                        </tr>                                   
                                    @endforeach
                                </tbody>
                            </table>                            
                        @else                   
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="text-center">
                                        No notification available.
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
