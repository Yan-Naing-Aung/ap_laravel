@extends("layout")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header" style="text-align:center">
                Edit Post
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Name Routing and data pass -->
                <form action="{{ route('posts.update',['post'=>$post->id]) }}" method="post">  
                
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name',$post->name) }}" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Enter Description">{{ old('description',$post->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <!-- Normal Resource Routing -->
                    <a href="/posts" class="btn btn-warning">Back</a>                   
                </form>
            </div>
        </div>
    </div>

@endsection