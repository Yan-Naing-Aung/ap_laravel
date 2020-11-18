@extends("layout")

@section("content")

<h1>This is contact page</h1>
    
    @foreach($data as $value)
    {{$value}}
    @endforeach


@endsection