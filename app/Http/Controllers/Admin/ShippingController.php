<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Shipping;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Validation\ValidationException;

    class ShippingController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Application|Factory|View
         */
        public function index()
        {
            $shipping = Shipping::orderBy('id', 'DESC')->paginate(10);
            return view('backend.shipping.index')->with('shippings', $shipping);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Application|Factory|View
         */
        public function create()
        {
            return view('backend.shipping.create');
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
                'type' => 'string|required',
                'price' => 'nullable|numeric',
                'status' => 'required|in:active,inactive',
            ]);
            $data = $request->all();
            // return $data;
            $status = Shipping::create($data);
            if ($status) {
                request()->session()->flash('success', 'Shipping successfully created');
            } else {
                request()->session()->flash('error', 'Error, Please try again');
            }
            return redirect()->route('shipping.index');
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Application|Factory|View
         */
        public function edit(int $id)
        {
            $shipping = Shipping::find($id);
            if (!$shipping) {
                request()->session()->flash('error', 'Shipping not found');
            }
            return view('backend.shipping.edit')->with('shipping', $shipping);
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
            $shipping = Shipping::find($id);
            $this->validate($request, [
                'type' => 'string|required',
                'price' => 'nullable|numeric',
                'status' => 'required|in:active,inactive',
            ]);
            $data = $request->all();
            // return $data;
            $status = $shipping->fill($data)->save();
            if ($status) {
                request()->session()->flash('success', 'Shipping successfully updated');
            } else {
                request()->session()->flash('error', 'Error, Please try again');
            }
            return redirect()->route('shipping.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return RedirectResponse
         */
        public function destroy(int $id): RedirectResponse
        {
            $shipping = Shipping::find($id);
            if ($shipping) {
                $status = $shipping->delete();
                if ($status) {
                    request()->session()->flash('success', 'Shipping successfully deleted');
                } else {
                    request()->session()->flash('error', 'Error, Please try again');
                }
                return redirect()->route('shipping.index');
            } else {
                request()->session()->flash('error', 'Shipping not found');
                return redirect()->back();
            }
        }
    }
