<?php

  namespace App\Http\Controllers;

  use App\Models\Post;
  use App\Models\PostComment;
  use App\Models\User;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;

  class PostCommentController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $comments = PostComment::getAllComments();

      return view('backend.comment.index', compact('comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
      $post_info = Post::getPostBySlug($request->slug);
      $data = $request->all();
      $data['user_id'] = $request->user()->id;
      $data['status'] = 'active';
      $status = PostComment::create($data);
      $user = User::get();
      $details = [
          'title'     => "New Comment created",
          'actionURL' => route('blog.detail', $post_info->slug),
          'fas'       => 'fas fa-comment',
      ];
//            Notification::send($user, new StatusNotification($details));
      if ($status) {
        request()->session()->flash('success', 'Thank you for your comment');
      } else {
        request()->session()->flash('error', 'Something went wrong! Please try again!!');
      }
      return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  PostComment  $postComment
     * @return Application|Factory|View
     */
    public function edit(PostComment $postComment)
    {
      return view('backend.comment.edit', compact('postComment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  PostComment  $postComment
     * @return RedirectResponse
     */
    public function update(Request $request, PostComment $postComment): RedirectResponse
    {
      $status = $postComment->fill($request->all())->update();
      if ($status) {
        request()->session()->flash('success', 'Comment successfully updated');
      } else {
        request()->session()->flash('error', 'Something went wrong! Please try again!!');
      }
      return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PostComment  $postComment
     * @return RedirectResponse
     */
    public function destroy(PostComment $postComment): RedirectResponse
    {
      $status = $postComment->delete();
      if ($status) {
        request()->session()->flash('success', 'Post Comment successfully deleted');
      } else {
        request()->session()->flash('error', 'Error occurred please try again');
      }
      return back();
    }
  }
