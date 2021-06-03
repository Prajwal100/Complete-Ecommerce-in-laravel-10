<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\PostCategory;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Validation\ValidationException;

    class PostCategoryController extends Controller
    {
        public function __construct()
        {
            $this->middleware('permission:postCategory-list');
            $this->middleware('permission:postCategory-create', ['only' => ['create', 'store']]);
            $this->middleware('permission:postCategory-edit', ['only' => ['edit', 'update']]);
            $this->middleware('permission:postCategory-delete', ['only' => ['destroy']]);
        }

        /**
         * Display a listing of the resource.
         *
         * @return Application|Factory|View
         */
        public function index()
        {
            $postCategories = PostCategory::orderBy('id', 'DESC')->paginate(10);
            return view('backend.postcategory.index', compact('postCategories'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Application|Factory|View
         */
        public function create()
        {
            return view('backend.postcategory.create');
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
            // return $request->all();
            $this->validate($request, [
                'title'  => 'string|required',
                'status' => 'required|in:active,inactive',
            ]);
            $status = PostCategory::create($request->all());
            if ($status) {
                request()->session()->flash('success', 'Post Category Successfully added');
            } else {
                request()->session()->flash('error', 'Please try again!!');
            }
            return redirect()->route('post-category.index');
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Application|Factory|View
         */
        public function edit(int $id)
        {
            $postCategory = PostCategory::findOrFail($id);
            return view('backend.postcategory.edit')->with('postCategory', $postCategory);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  Request  $request
         * @param  PostCategory  $postCategory
         * @return RedirectResponse
         */
        public function update(Request $request, PostCategory $postCategory): RedirectResponse
        {
            $status = $postCategory->update($request->all());
            if ($status) {
                request()->session()->flash('success', 'Post Category Successfully updated');
            } else {
                request()->session()->flash('error', 'Please try again!!');
            }
            return redirect()->route('post-category.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  PostCategory  $postCategory
         * @return RedirectResponse
         */
        public function destroy(PostCategory $postCategory): RedirectResponse
        {
            $status = $postCategory->delete();

            if ($status) {
                request()->session()->flash('success', 'Post Category successfully deleted');
            } else {
                request()->session()->flash('error', 'Error while deleting post category');
            }
            return redirect()->route('post-category.index');
        }
    }
