<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('dashboard.departments.index');
    }

    /**
     * Display a element for dataTables
     *
     *
     */
    public function getAdminsforDatatables(Request $request)
    {


        $departments = \App\Department::orderBy('created_at', 'DESC');


        return DataTables::of($departments)
            ->editColumn('created_at', function ($depart) {
                $date = app()->getLocale();
//                \Illuminate\Support\Carbon::setLocale($date);
                return \Carbon\Carbon::parse($depart->created_at)->format('d- M- Y');
            })
            ->addColumn('name_ar', function ($depart) {

                return '<a href="#" id="name_ar" class="editable" data-type="text" data-pk="' . $depart->id . '"
                                               data-url="' . route("departments.update", ["id" => $depart->id]) . '"
                                               data-title="' . __("name") . '">' . $depart->getTranslationAttribute('name_ar')->content . '</a></td>';
            })
            ->addColumn('name_en', function ($depart) {
                return '<a href="#" id="name_en" class="editable" data-type="text" data-pk="' . $depart->id . '"
                                               data-url="' . route("departments.update", ["id" => $depart->id]) . '"
                                               data-title="' . __("name") . '">' . $depart->getTranslationAttribute('name_en')->content . '</a></td>';
            })
            ->addColumn('action', function ($depart) {
                return '
                <form action=" ' . route('departments.destroy', ['id' => $depart->id]) . '" method="POST"
                                                  style="display:inline-block">
   
                                                  ' . csrf_field() . '
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger delete-entry"
                                                        style="margin: 4px 0;min-width: 85px;" type="submit"><i
                                                            class="fa fa-times"></i> ' . __('Delete') . '
                                                </button>
                                            </form>
                ';
            })
            ->rawColumns(['name_ar', 'name_en', 'action'])
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
            'name_*' => "min:3|required",
        ]);
        if ($validator->fails()) {
            $arr = array();
            $arr["state"] = false;
            return json_encode($arr);
        }
        $depart = Department::create(['name' => 'NewDepart']);
        if ($depart) {
            $depart->translations()->saveMany([
                new \App\Translation(['content' => $request->name_ar, 'language' => 'ar', 'col_title' => 'name_ar']),
                new \App\Translation(['content' => $request->name_en, 'language' => 'en', 'col_title' => 'name_en']),
            ]);
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

        $depart = Department::find($request->id);

        if ($depart) {

            $validator = \Validator::make($request->all(),
                [
                    'name_*' => "min:3",
                ]);
            if ($validator->fails()) {
                return $validator->messages();
            }

            $field = $depart->getTranslationAttribute($request->name);
            $field->content = $request->value;
            $field->save();
            return $field;
//                new \App\Translation(['content' => $request->value,'language'=>$lang, 'col_title' => $request->name])
//            );

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
        $depart = Department::find($request->id);


        if ($depart)
            if ($request->json()) {
                $depart->translations()->delete();
                $depart->delete();
                $arr = array();
                $arr["state"] = true;
                return json_encode($arr);
            }
        return redirect(route('departments.index'));

    }

}
