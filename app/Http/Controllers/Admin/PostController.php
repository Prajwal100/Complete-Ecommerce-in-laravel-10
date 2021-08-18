<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Http\Requests\Post\Store;
  use App\Http\Requests\Post\Update;
  use App\Models\Post;
  use App\Models\PostCategory;
  use App\Models\Tag;
  use App\Models\User;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;

  class PostController extends Controller
  {
    public function __construct()
    {
      $this->middleware('permission:post-list');
      $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $posts = Post::getAllPost();
      return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
      $categories = PostCategory::get();
      $tags = Tag::get();
      $users = User::get();
      return view('backend.post.create', compact('users', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
      $tags = $request->input('tags');
      if ($tags) {
        $data['tags'] = implode(',', $tags);
      } else {
        $data['tags'] = '';
      }

      $status = Post::create($data);
      if ($status) {
        request()->session()->flash('success', 'Post Successfully added');
      } else {
        request()->session()->flash('error', 'Please try again!!');
      }
      return redirect()->route('post.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
      $categories = PostCategory::get();
      $tags = Tag::get();
      $users = User::get();
      return view('backend.post.edit', compact('post', 'categories', 'tags', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Update  $request
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function update(Update $request, Post $post): RedirectResponse
    {
      $data = $request->all();
      $tags = $request->input('tags');
      // return $tags;
      if ($tags) {
        $data['tags'] = implode(',', $tags);
      } else {
        $data['tags'] = '';
      }

      $status = $post->update($data);
      if ($status) {
        request()->session()->flash('success', 'Post Successfully updated');
      } else {
        request()->session()->flash('error', 'Please try again!!');
      }
      return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
      $status = $post->delete();

      if ($status) {
        request()->session()->flash('success', 'Post successfully deleted');
      } else {
        request()->session()->flash('error', 'Error while deleting post ');
      }
      return redirect()->route('post.index');
    }
  }
