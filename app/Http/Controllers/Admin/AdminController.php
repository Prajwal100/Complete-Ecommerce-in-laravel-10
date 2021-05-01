<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\Store;
use App\Http\Requests\Settings\Update;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"),
            DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();
        $array[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }
        return view('backend.index')->with('users', json_encode($array));
    }

    public function profile()
    {
        $profile = Auth()->user();
        return view('backend.users.profile')->with('profile', $profile);
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return RedirectResponse
     */
    public function profileUpdate(Request $request, $id): RedirectResponse
    {
        // return $request->all();
        $user = User::findOrFail($id);
        $data = $request->all();
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Successfully updated your profile');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->back();
    }

    /**
     * @return Application|Factory|View
     */
    public function settings()
    {
        $data = Settings::first();
        return view('backend.setting')->with('data', $data);
    }

    /**
     * @param  Update  $request
     * @return RedirectResponse
     */
    public function settingsUpdate(Update $request): RedirectResponse
    {
        $settings = Settings::first();
        $status = $settings->update($request->all());
        if ($status) {
            request()->session()->flash('success', 'Setting successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again');
        }
        return redirect()->route('admin');
    }

    /**
     * @return Application|Factory|View
     */
    public function changePassword()
    {
        return view('backend.layouts.changePassword');
    }

    public function changPasswordStore(Store $request): RedirectResponse
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('admin')->with('success', 'Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request)
    {
        $data = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"),
            DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();
        $array[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }
        return view('backend.index')->with('course', json_encode($array));
    }

}
