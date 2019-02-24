<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.admins.index');
    }

    /**
     * Display a element for dataTables
     *
     *
     */
    public function getAdminsforDatatables(Request $request)
    {

        $admins = \App\Admin::orderBy('created_at', 'DESC');
        return DataTables::of($admins)
            ->editColumn('created_at', function ($admin) {
//                \Illuminate\Support\Carbon::setLocale(app()->getLocale());
                return \Carbon\Carbon::parse($admin->created_at)->format('d M Y');
            })
            ->addColumn('name', function ($admin) {
                return '<a href="#" id="name" class="editable" data-type="text" data-pk="' . $admin->id . '"
                                               data-url="' . route("admins.update", ["id" => $admin->id]) . '"
                                               data-title="' . __("name") . '">' . $admin->name . '</a></td>';
            })
            ->addColumn('email', function ($admin) {
                return '
               <a href="#" id="email" class="editable" data-type="email" data-pk="' . $admin->id . '"
                                               data-url="' . route("admins.update", ["id" => $admin->id]) . '"
                                               data-title="' . __("email") . '">' . $admin->email . '</a></td>';
            })
            ->addColumn('action', function ($admin) {
                return '
                 <button class="btn btn-sm btn-info"
                                                    data-toggle="modal" data-target="#myModal_' . $admin->id . '"
                                                    style="margin: 4px 0;min-width: 85px;"
                                            ><i class="fa fa-pencil"></i>
                                                ' . __('Edit Password') . '</button>
                                            <div class="modal fade editpass" id="myModal_' . $admin->id . '" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i
                                                                        class="fa fa-pencil"></i> ' . __('Edit Password') . '</h4>
                                                        </div>
                                                        <form action="' . route('admins.update', ['id' => $admin->id]) . '"
                                                              method="post">
                                                            <div class="modal-body">
                                                                ' . csrf_field() . '
                                                                <input name="_method" type="hidden" value="PUT">
                                                                <div class="form-group" style="width: 100%!important;">
                                                                    <label for="password">' . __('password') . '</label>
                                                                    <br>
                                                                    <input type="password" class="form-control"
                                                                           id="password_' . $admin->id . '" name="password" required
                                                                           style="width: 100%!important;"
                                                                           placeholder="' . __('password') . '">
                                                                </div>
                                                                <br>
                                                                <div class="form-group" style="width: 100%!important;">
                                                                    <label for="password-confirm">' . __('confirm password') . '</label>
                                                                    <br>
                                                                    <input type="password" class="form-control"
                                                                           id="password-confirm_' . $admin->id . '" name="password_confirm"
                                                                           required style="width: 100%!important;"
                                                                           placeholder="' . __('confirm password') . '">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                        class="btn btn-primary update-entry">' . __('save') . '</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <form action=" ' . route('admins.destroy', ['id' => $admin->id]) . '" method="POST"
                                                  style="display:inline-block">
   
                                                  ' . csrf_field() . '
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger delete-entry"
                                                        style="margin: 4px 0;min-width: 85px;" ' . ($admin->id == 1 ? 'disabled' : '-') . ' type="submit"><i
                                                            class="fa fa-times"></i> ' . __('Delete') . '
                                                </button>
                                            </form>
                ';
            })
            ->rawColumns(['name', 'email', 'action'])
            ->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => "min:3",
            "email" => "unique:admins|email|max:219",
            "password" => 'required|min:6|same:password_confirm'
        ]);
        if ($validator->fails()) {
            $arr = array();
            $arr["state"] = false;
            return json_encode($arr);
        }
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($admin) {

            return json_encode(3);
        } else {
            $arr = array();
            $arr["state"] = false;
            return json_encode($arr);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        return $request->all();
        $admin = Admin::find($request->id);
        if ($admin) {

            $validator = \Validator::make($request->all(),
                [
                    'name' => "min:3",
                    'password' => 'min:6|same:password_confirm'
                ]);
            if ($validator->fails()) {
                return $validator->messages();
            }

            if ($request->name == 'name') {
                $admin->name = $request->value;
            }
            if ($request->name == 'email') {
                $validator = \Validator::make($request->all(), [
                    $request->name => "unique:admins,email,'.$admin->id.'|email|max:219",
                ]);
                if ($validator->fails()) {
                    return $validator->messages();
                }

                $admin->email = $request->value;
                $admin->save();
            }


            if ($request->has('password')) {
                $admin->password = bcrypt($request->password);
                if ($admin->save()) {
                    return json_encode(3);
                }

            }
            $admin->save();
            return $admin;
        } else {
            return 'false';
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $admin = Admin::find($request->id);
        if ($admin)
            if ($request->json) {
                $admin->delete();
                $arr = array();
                $arr["state"] = true;
                return json_encode($arr);
            }
        return redirect(route('admins.index'));

    }

    function getLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin/');
        }

        return view('dashboard.login');
    }

    function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $remember = ($request->remember == 'on') ? true : false;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            session()->flash('success', __('success'));
            return redirect('/admin');
        } else {
            session()->flash('fail', __('fail'));
            return redirect()->back();
        }

    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    function dashboard()
    {
        return view('dashboard.index');
    }
}
