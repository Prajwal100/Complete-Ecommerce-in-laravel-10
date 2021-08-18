<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Models\Notification;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Routing\Redirector;

  class NotificationController extends Controller
  {
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
      return view('backend.notification.index');
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function show(Request $request)
    {
      $notification = Auth()->user()->notifications()->where('id', $request->id)->first();
      if ($notification) {
        $notification->markAsRead();
        return redirect($notification->data['actionURL']);
      }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
      $notification = Notification::find($id);
      if ($notification) {
        $status = $notification->delete();
        if ($status) {
          request()->session()->flash('success', 'Notification successfully deleted');
          return back();
        } else {
          request()->session()->flash('error', 'Error please try again');
          return back();
        }
      } else {
        request()->session()->flash('error', 'Notification not found');
        return back();
      }
    }
  }
