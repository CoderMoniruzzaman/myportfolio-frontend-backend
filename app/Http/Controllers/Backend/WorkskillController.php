<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Validator;
use DataTables;

class WorkskillController extends Controller
{
    public function index(request $request)
    {
        if($request->ajax())
        {

            $data = Skill::latest()->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status',function($data){
                if($data->status == 1){

                    $status = '<button name="status" data-id="'.$data->id.'" class="skill_status btn btn-success btn-sm">Active</button>';
                }
                else{
                    $status = '<button name="status" data-id="'.$data->id.'" class="skill_status btn btn-danger btn-sm">Deactive</button>';
                }
                return $status;
            })

            ->addColumn('created_at',function($data){
                $time = $data->created_at->format('d-M-Y h:i:s A').'<br>';
                $time .=$data->created_at->diffForHumans();
                return $time;
            })
            ->addColumn('action',function($data){
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editskillmodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="skill_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.work.skilltag.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $rules = array(
            'skill_name' => 'required|unique:skills,skill_name',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Skill;
            $form_data->skill_name = $request->skill_name;
            $form_data->save();
            return response()->json(['success'=>'skill added successfully.']);
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
            $data = Skill::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function skillupdate(Request $request)
    {
        $rules = array(
            'skill_name' => 'required|unique:skills,skill_name',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'skill_name'    =>  $request->skill_name,
            );
            Skill::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'skill is successfully updated']);
        }
        return response()->json(['success' => 'skill is successfully updated']);
    }


    public function skillstatus($s_id)
    {   if( Skill::find($s_id)->status==1){
            if(Skill::find($s_id)){
                Skill::findOrFail($s_id)->update(['status' => 0]);
            }
            return response()->json(['infos'=>'Status deactive successfully.']);
        }

        else {
                Skill::findOrFail($s_id)->update([
                    'status' => 1,
                ]);
                return response()->json(['success'=>'Status active successfully.']);
            }

    }


    public function destroy($id)
    {
        //
    }

    public function skilldelete($s_id)
    {
        $category = Skill::findOrFail($s_id);
        if ($category){
            $category->delete();
            return response()->json(array('success' => true));
        }
    }








}
