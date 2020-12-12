@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
       <form method="post" action="{{ route('posts.update' , $post->id)}}">

          @method('PUT')
   @csrf

  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" name="title" class="form-control" value="{{ $post->title }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Body</label>
    <input type="text" name="body" class="form-control" value="{{ $post->body }}">
  </div>
  

  <div class="form-group">
    <label for="exampleFormControlSelect1">Category select</label>
    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
    @foreach ($categories as  $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>

    @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Tags  select</label>
    <select  multiple name="tag_id[]" class="form-control" id="exampleFormControlSelect2">
      @foreach ($tags as  $tag)
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>

    @endforeach
  
    </select>
  </div>

  
  <div class="form-group">
    <button type="submit"   class="btn btn-primary"/>Update Post</button>
  </div>

</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection