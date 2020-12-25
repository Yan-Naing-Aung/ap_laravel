@extends("layout")

@section("content")
    <div class="container">
        <div>
            <a href="/posts/create" class="btn btn-success">New Post</a>
            <a href="/logout" class="btn btn-default">Logout</a>
            <h4 style="float:right">{{ Auth::user()->name }}</h4>
        </div>
        <br>
            @if(session('status'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{session('status')}}
            </div>
            @endif
        <div class="card">
            <div class="card-header" style="text-align:center">
                Contents
            </div>
            <div class="card-body">
           
                @foreach($posts as $post)
                <div>
                    <h5 class="card-title">{{$post->name}}</h5>
                    <p class="card-text">{{$post->description}}</p>
                    <div class="form-row">
                        <a href="posts/{{ $post->id }}" class="btn btn-primary" style="height:38px;margin-right:5px">View</a>
                        <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-success" style="height:38px;margin-right:5px">Edit</a>
                                <!-- Name Routing on edit page -->
                        <form action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    
                </div><hr>
                @endforeach
            </div>
        </div>
    </div>

@endsection