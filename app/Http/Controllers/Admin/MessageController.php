<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Models\Message;
  use Carbon\Carbon;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;

  class MessageController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $messages = Message::paginate(20);
      return view('backend.message.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Message  $message
     * @return Application|Factory|View
     */
    public function show(Message $message)
    {
      if (true) {
        $message->read_at = Carbon::now();
        $message->save();
        return view('backend.message.show', compact('message'));
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Message  $message
     * @return RedirectResponse
     */
    public function destroy(Message $message): RedirectResponse
    {
      $status = $message->delete();
      if ($status) {
        request()->session()->flash('success', 'Successfully deleted message');
      } else {
        request()->session()->flash('error', 'Error occurred please try again');
      }
      return back();
    }
  }
