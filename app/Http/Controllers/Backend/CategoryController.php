<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
//use Yajra\Datatables\Facades\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Category::latest()->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status',function($data){
                if($data->status == 1){

                    $status = '<button name="status" data-id="'.$data->id.'" class="change_status btn btn-success btn-sm">Active</button>';
                }
                else{
                    $status = '<button name="status" data-id="'.$data->id.'" class="change_status btn btn-danger btn-sm">Deactive</button>';
                }
                return $status;
            })

            ->addColumn('created_at',function($data){
                $time = $data->created_at->format('d-M-Y h:i:s A').'<br>';
                $time .=$data->created_at->diffForHumans();
                return $time;
            })
            ->addColumn('action',function($data){
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editmodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="category_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.work.category.index');
    }


    public function create()
    {
        return view('backend.page.work.category.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'category_name' => 'required|unique:categories,category_name',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Category;
            $form_data->category_name = $request->category_name;
            $form_data->save();
            //return response()->json($form_data);
            return response()->json(['success'=>'Category added successfully.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Category::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function categoryupdate(Request $request)
    {
        $rules = array(
            'category_name' => 'required|unique:categories,category_name',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'category_name'    =>  $request->category_name,
            );
            Category::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Category is successfully updated']);
        }
        return response()->json(['success' => 'Category is successfully updated']);
    }

    public function destroy($id)
    {
        //
    }

    public function categorydelete($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        if ($category){
            $category->delete();
            return response()->json(array('success' => true));
        }


        // Category::find($request->id)->delete();
        // return response()->json(array('success' => true));
    }


    public function changestatus($cat_id)
    {
        if(Category::find($cat_id)->status == 1){
            Category::findOrFail($cat_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            Category::findOrFail($cat_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }


}
