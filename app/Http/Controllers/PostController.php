<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    protected $model;
    public function __construct(Post $post){
       // set the model 
   $this->model = new Repository($post);
    }

    public function index() 
    { 
        $posts  =  $this->model->all();
        $trashed_posts =$this->model->trashed(); 
       // dd($trashed_posts); 
        return view('admin' , compact('posts' , 'trashed_posts')); 
    }
    public function create(){
        $categories = Category::all(); 
        $tags = Tag::all(); 
        return view('create' , compact('categories' , 'tags'));
    }

     public function store(PostRequest $request)
      { 
          $this->validate($request, [ 'body' => 'required|max:500' ]);

           // create record and pass in only fields that are fillable 
  $post =   $this->model->create($request->only($this->model->getModel()->fillable));
      $this->model->show($post['id'])->tags()->sync($request->tag_id); 


    return redirect('/posts');


 } 
 public function show($id) 
 { 
     return $this->model->show($id); 
}

public function edit($id) {
    $post = $this->model->show($id); 
    $categories = Category::all(); 
    $tags = Tag::all(); 

    
    return view('edit' , compact('categories' , 'tags' ,  'post')); 
     
  }

public function update(PostRequest $request, $id) {
  // update model and only pass in the fillable fields 
  
  $this->model->update($request->only($this->model->getModel()->fillable), $id);
  $this->model->show($id)->tags()->sync($request->tag_id); 
  
  return redirect('/posts');
   
}
public function restore($id){
    $this->model->restore($id);
    return back(); 

}
public function forceDelete($id){
    $this->model->forceDelete($id);
    return back(); 

}
      public function destroy($id) { 
     
         $this->model->delete($id);
         return redirect()->back(); 
     
        }

}
