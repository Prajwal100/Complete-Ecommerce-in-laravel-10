<?php


  namespace App\Http\Controllers\Admin;


  use App\Http\Controllers\Controller;
  use App\Models\User;
  use DB;
  use Hash;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Support\Arr;
  use Illuminate\Validation\ValidationException;
  use Spatie\Permission\Models\Role;


  class UsersController extends Controller

  {

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(Request $request)
    {
      $users = User::orderBy('id', 'DESC')->paginate(5);
      return view('backend.users.index', compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */

    public function create()

    {
      $user = new User();
      $roles = Role::all();
      return view('backend.users.create', compact('roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
      $this->validate($request, [
          'name'     => 'required',
          'email'    => 'required|email|unique:users,email',
          'password' => 'required|same:confirm-password',
          'roles'    => 'required',
      ]);
      $input = $request->all();
      $input['password'] = Hash::make($input['password']);
      $user = User::create($input);
      $user->assignRole($request->input('roles'));
      return redirect()->route('users.index')->with('success', 'User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */

    public function show(int $id)
    {
      $user = User::find($id);
      return view('backend.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */

    public function edit(int $id)
    {
      $user = User::find($id);
      $roles = Role::all();
      $userRole = $user->roles->pluck('name', 'name')->all();
      return view('backend.users.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     * @throws ValidationException
     */

    public function update(Request $request, int $id): RedirectResponse
    {
      $this->validate($request, [
          'name'     => 'required',
          'email'    => 'required|email|unique:users,email,'.$id,
          'password' => 'same:confirm-password',
          'roles'    => 'required',
      ]);


      $input = $request->all();

      if (!empty($input['password'])) {
        $input['password'] = Hash::make($input['password']);
      } else {
        $input = Arr::except($input, ['password']);
      }

      $user = User::findOrFail($id);

      $user->update($input);
      DB::table('model_has_roles')->where('model_id', $id)->delete();
      $user->assignRole($request->input('roles'));
      return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return RedirectResponse
     */

    public function destroy(User $user): RedirectResponse
    {
      $user->delete();
      return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

  }
