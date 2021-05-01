<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\Store;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return JsonResponse
     */
    public function messageFive(): JsonResponse
    {
        $message = Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return Response
     */
    public function store(Store $request): Response
    {
        $message = Message::create($request->all());
        // return $message;
        $data = array();
        $data['url'] = route('message.show', $message->id);
        $data['date'] = $message->created_at->format('F d, Y h:i A');
        $data['name'] = $message->name;
        $data['email'] = $message->email;
        $data['phone'] = $message->phone;
        $data['message'] = $message->message;
        $data['subject'] = $message->subject;
        $data['photo'] = Auth()->user()->photo;
        // return $data;
        event(new MessageSent($data));
        exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  Message  $message
     * @return RedirectResponse
     */
    public function show(Request $request, Message $message): RedirectResponse
    {
        if ($message) {
            $message->read_at = Carbon::now();
            $message->save();
            return view('backend.message.show')->with('message', $message);
        } else {
            return back();
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
