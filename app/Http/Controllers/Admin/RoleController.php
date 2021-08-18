<?php


  namespace App\Http\Controllers\Admin;


  use App\Http\Controllers\Controller;
  use DB;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Validation\ValidationException;
  use Spatie\Permission\Models\Permission;
  use Spatie\Permission\Models\Role;


  class RoleController extends Controller

  {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    function __construct()
    {
      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
      $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(Request $request)
    {
      $roles = Role::orderBy('id', 'DESC')->paginate(5);
      return view('backend.roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */

    public function create()

    {
      $permission = Permission::get();
      return view('backend.roles.create', compact('permission'));
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
          'name'       => 'required|unique:roles,name',
          'permission' => 'required',
      ]);
      $role = Role::create(['name' => $request->input('name')]);
      $role->syncPermissions($request->input('permission'));

      return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */

    public function show(int $id)
    {
      $role = Role::find($id);

      $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=",
          "permissions.id")
          ->where("role_has_permissions.role_id", $id)
          ->get();

      return view('backend.roles.show', compact('role', 'rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */

    public function edit(int $id)
    {
      $role = Role::find($id);
      $permission = Permission::get();
      $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
          ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
          ->all();
      return view('backend.roles.edit', compact('role', 'permission', 'rolePermissions'));
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
          'name'       => 'required',
          'permission' => 'required',
      ]);
      $role = Role::find($id);
      $role->name = $request->input('name');
      $role->save();
      $role->syncPermissions($request->input('permission'));
      return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */

    public function destroy(int $id): RedirectResponse
    {
      DB::table("roles")->where('id', $id)->delete();
      return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

  }
