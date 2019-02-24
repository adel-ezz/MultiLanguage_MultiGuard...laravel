<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index()
    {
        //
        $departments = Department::latest()->get();
        return view('dashboard.users.index', compact('departments'));
    }

    /**
     * Display a element for dataTables
     *
     *
     */
    public function getAdminsforDatatables(Request $request)
    {

        $users = \App\User::orderBy('created_at', 'DESC');
        $departments = Department::latest()->get();
        $select = '';
        foreach ($departments as $depart) {
            $select .=
                '<option value="' . $depart->id . '">' . $depart->getTranslationAttribute('name_' . \app()->getLocale())->content . '</option>';
        }
        return DataTables::of($users)
            ->editColumn('created_at', function ($user) {
                return \Carbon\Carbon::parse($user->created_at)->format('d M Y');
            })
            ->addColumn('name', function ($user) {
                return '<a href="#" id="name" class="editable" data-type="text" data-pk="' . $user->id . '"
                                               data-url="' . route("users.update", ["id" => $user->id]) . '"
                                               data-title="' . __("name") . '">' . $user->name . '</a></td>';
            })
            ->addColumn('email', function ($user) {
                return '
               <a href="#" id="email" class="editable" data-type="email" data-pk="' . $user->id . '"
                                               data-url="' . route("users.update", ["id" => $user->id]) . '"
                                               data-title="' . __("email") . '">' . $user->email . '</a></td>';
            })
            ->addColumn('action', function ($user) use ($select) {
                return '
                 <button class="btn btn-sm btn-info"
                                                    data-toggle="modal" data-target="#myModal_' . $user->id . '"
                                                    style="margin: 4px 0;min-width: 85px;"
                                            ><i class="fa fa-pencil"></i>
                                                ' . __("Edit") . '</button>
                                            <div class="modal fade editpass" id="myModal_' . $user->id . '" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title"><i
                                                                        class="fa fa-pencil"></i> ' . __("Edit") . '</h4>
                                                        </div>
                                                        <form action="' . route('users.update', ['id' => $user->id]) . '"
                                                              method="post">
                                                            <div class="modal-body">
                                                                ' . csrf_field() . '
                                                                <input name="_method" type="hidden" value="PUT">
                                                                  <div class="form-group" style="width: 100%!important;">
                                                                    <label for="password">' . __('Department') . '</label>
                                                                    <br>
                                                                     <select class="form-control select2" required
                                                                style="width: 100%;" name="department">
                                                            <option selected="selected"
                                                                    disabled>' . __('select') . '</option>
                                                      ' . $select . '
                                                        </select>
                                                                </div>
                                                                <br>
                                                                <div class="form-group" style="width: 100%!important;">
                                                                    <label for="password">' . __('password') . '</label>
                                                                    <br>
                                                                    <input type="password" class="form-control"
                                                                           id="password_' . $user->id . '" name="password" required
                                                                           style="width: 100%!important;"
                                                                           placeholder="' . __('password') . '">
                                                                </div>
                                                                <br>
                                                                
                                                                <div class="form-group" style="width: 100%!important;">
                                                                    <label for="password-confirm">' . __('confirm password') . '</label>
                                                                    <br>
                                                                    <input type="password" class="form-control"
                                                                           id="password-confirm_' . $user->id . '" name="password_confirm"
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
                                            <form action=" ' . route('users.destroy', ['id' => $user->id]) . '" method="POST"
                                                  style="display:inline-block">
   
                                                  ' . csrf_field() . '
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger delete-entry"
                                                        style="margin: 4px 0;min-width: 85px;"  type="submit"><i
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
            'name' => "required|min:3",
            "email" => "required|unique:users|email|max:219",
            "department" => "required",
            "password" => 'required|min:6|same:password_confirm'
        ]);

        if ($validator->fails()) {
//            return $validator->messages();
            $arr = array();
            $arr["state"] = false;
            return json_encode($arr);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {

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
        $user = User::find($request->id);
        if ($user) {

            $validator = \Validator::make($request->all(),
                [
                    'name' => "min:3",

                    'password' => 'min:6|same:password_confirm'
                ]);
            if ($validator->fails()) {
                return $validator->messages();
            }

            if ($request->name == 'name') {
                $user->name = $request->value;
            }
            if ($request->name == 'email') {
                $validator = \Validator::make($request->all(), [
                    $request->name => "unique:users,email,'.$user->id.'|email|max:219",
                ]);
                if ($validator->fails()) {
                    return $validator->messages();
                }

                $user->email = $request->value;
                $user->save();
            }
            if ($request->has('department')) {
                $user->department_id = $request->value;
            }
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
                if ($user->save()) {
                    return json_encode(3);
                }

            }
            $user->save();
            return $user;
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
        $user = User::find($request->id);
        if ($user)
            if ($request->json) {
                $user->delete();
                $arr = array();
                $arr["state"] = true;
                return json_encode($arr);
            }
        return redirect(route('users.index'));

    }

}
