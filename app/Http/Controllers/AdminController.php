<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{

 public function __construct() {

    $this->middleware("admin");
 }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [

            'posts'=> Post::without('category', 'tags')->latest()->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View

    {
        return $this->showForm();

    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) : View{

        return $this->showForm($post);

    }


    public function showForm(Post $post = new Post): View
    {
        return view('admin.posts.form', [
            'post'=> $post,
            'categories'=>  Category::orderBy('name')->get(),
            'tags'=>  Tag::orderBy('name')->get(),
        ]);


    }



    public function store(PostRequest $request): RedirectResponse
    {

       // $post = Post::create($request->all());
     return  $this->save($request->validated());

      //   return redirect()->route('')->with('success','');


    }




    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post) : RedirectResponse
    {
      return  $this->save($request->validated(), $post);
    }


protected function save(array $data, Post $post = null): RedirectResponse {

   if(isset($data['thumbnails'])){

    if(isset($post->thumbnail)){

        Storage::delete($post->thumbnail);
    }
       $data['thumbnail'] = $data['thumbnail']->store('thumbnail');

   }

    $data['excerpt'] = Str::limit($data['content'],150);
// dd($data);

    $post = Post::updateOrCreate(['id' => $post?->id], $data);
    $post->tags()->sync($data['tag_ids'] ?? null );

    return redirect()->route('posts.show', ['post' => $post])->withStatus($post->wasRecentlyCreated ?'post publie !' : 'post mis a jour ');


}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->thumbnail);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
