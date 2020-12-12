@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Hi  {{ Auth::user()->name }}
                        <table class="table">
  <thead>
    <tr>
      <th scope="col">title</th>
      <th scope="col">body</th>
      <th scope="col">Catgory</th>
            <th scope="col">Edit</th>
      <th scope="col">Delete</th>

    </tr>
  </thead>
  <tbody>
@foreach ($posts as $post )
        <tr>
      <td>{{ $post->title }}</td>
      <td>{{$post->body}}</td>
      <td>{{ $post->category->name }}</td>
            <td>{{ $post->category->name }}</td>
      <td>
     <form action="{{ route('posts.destroy', $post->id)}}" method="post">
   @method('DELETE')
   @csrf
   <input class="btn btn-danger" type="submit" value="Delete" />
</form>
      </td>

    </tr>
@endforeach

  </tbody>
</table>

<div class="card">
<b style="color:red">Trashed Data</b>
//trashed_posts


                        <table class="table">
  <thead>
    <tr>
      <th scope="col">title</th>
            <th scope="col">Restore</th>
      <th scope="col">Delete forever</th>

    </tr>
  </thead>
  <tbody>
@foreach ($trashed_posts as $trashed_post )
        <tr>
      <td>{{ $trashed_post->title }}</td>
<td><a class="btn btn-info" href="{{ route('posts.restore' , $trashed_post->id) }}" >Restore</a></td>
<td><a class="btn btn-danger" href="{{ route('posts.force' , $trashed_post->id) }}" >Delete Forever</a></td>


    </tr>
@endforeach

  </tbody>
</table>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection