<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Models\Order;
  use App\Models\PostComment;
  use App\Models\ProductReview;
  use App\Models\User;
  use App\Rules\MatchOldPassword;
  use Hash;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\Support\Renderable;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;

  class HomeController extends Controller
  {
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
      return view('user.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function profile()
    {
      $profile = Auth()->user();
      return view('user.users.profile', compact('profile'));
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return RedirectResponse
     */
    public function profileUpdate(Request $request, $id): RedirectResponse
    {
      $user = User::findOrFail($id);
      $status = $user->update($request->all());
      if ($status) {
        request()->session()->flash('success', 'Successfully updated your profile');
      } else {
        request()->session()->flash('error', 'Please try again!');
      }
      return redirect()->back();
    }

    /**]
     * @return Application|Factory|View
     */
    public function orderIndex()
    {
      $orders = Order::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->paginate(10);
      return view('user.order.index')->with('orders', $orders);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function userOrderDelete($id): RedirectResponse
    {
      $order = Order::find($id);
      if ($order) {
        if ($order->status == "process" || $order->status == 'delivered' || $order->status == 'cancel') {
          return redirect()->back()->with('error', 'You can not delete this order now');
        } else {
          $status = $order->delete();
          if ($status) {
            request()->session()->flash('success', 'Order Successfully deleted');
          } else {
            request()->session()->flash('error', 'Order can not deleted');
          }
          return redirect()->route('user.order.index');
        }
      } else {
        request()->session()->flash('error', 'Order can not found');
        return redirect()->back();
      }
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function orderShow($id)
    {
      $order = Order::find($id);
      return view('user.order.show')->with('order', $order);
    }

    /**
     * @return Application|Factory|View
     */
    public function productReviewIndex()
    {
      $reviews = ProductReview::getAllUserReview();
      return view('user.review.index')->with('reviews', $reviews);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function productReviewEdit($id)
    {
      $review = ProductReview::find($id);
      return view('user.review.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function productReviewUpdate(Request $request, int $id): RedirectResponse
    {
      $review = ProductReview::find($id);
      if ($review) {
        $data = $request->all();
        $status = $review->fill($data)->update();
        if ($status) {
          request()->session()->flash('success', 'Review Successfully updated');
        } else {
          request()->session()->flash('error', 'Something went wrong! Please try again!!');
        }
      } else {
        request()->session()->flash('error', 'Review not found!!');
      }

      return redirect()->route('user.productreview.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function productReviewDelete(int $id): RedirectResponse
    {
      $review = ProductReview::find($id);
      $status = $review->delete();
      if ($status) {
        request()->session()->flash('success', 'Successfully deleted review');
      } else {
        request()->session()->flash('error', 'Something went wrong! Try again');
      }
      return redirect()->route('user.productreview.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function userComment()
    {
      $comments = PostComment::getAllUserComments();
      return view('user.comment.index')->with('comments', $comments);
    }

    /**
     * @param  int  $id
     * @return RedirectResponse
     */
    public function userCommentDelete(int $id): RedirectResponse
    {
      $comment = PostComment::find($id);
      if ($comment) {
        $status = $comment->delete();
        if ($status) {
          request()->session()->flash('success', 'Post Comment successfully deleted');
        } else {
          request()->session()->flash('error', 'Error occurred please try again');
        }
        return back();
      } else {
        request()->session()->flash('error', 'Post Comment not found');
        return redirect()->back();
      }
    }

    /**]
     * @param  int  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function userCommentEdit(int $id)
    {
      $comments = PostComment::find($id);
      if ($comments) {
        return view('user.comment.edit')->with('comment', $comments);
      } else {
        request()->session()->flash('error', 'Comment not found');
        return redirect()->back();
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function userCommentUpdate(Request $request, int $id): RedirectResponse
    {
      $comment = PostComment::find($id);
      if ($comment) {
        $data = $request->all();
        // return $data;
        $status = $comment->fill($data)->update();
        if ($status) {
          request()->session()->flash('success', 'Comment successfully updated');
        } else {
          request()->session()->flash('error', 'Something went wrong! Please try again!!');
        }
        return redirect()->route('user.post-comment.index');
      } else {
        request()->session()->flash('error', 'Comment not found');
        return redirect()->back();
      }
    }

    /**
     * @return Application|Factory|View
     */
    public function changePassword()
    {
      return view('user.layouts.userPasswordChange');
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function changPasswordStore(Request $request): RedirectResponse
    {
      $request->validate([
          'current_password'     => ['required', new MatchOldPassword],
          'new_password'         => ['required'],
          'new_confirm_password' => ['same:new_password'],
      ]);

      User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

      return redirect()->route('user')->with('success', 'Password successfully changed');
    }


  }
