<?php

namespace App\Http\Controllers;
use App\Area;
use App\Country;
use App\Http\Requests\StateUpdValidationRequest;
use App\Http\Requests\StateValidationRequest;
use App\State;
use Illuminate\Http\Request;
use Crypt;
use Yajra\Datatables\Datatables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,State $state)
    {
       
       return view('admin.addstate');
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateValidationRequest $request,State $state)
    {
        
 
       
        $res= new State;
        $res->state=$request->input('state');
        $res->country_id=$request->input('country');
        $res->status=$request->input('status');
        $res->save();
          /*$request->session()->flash('msg','State Added Successfully');
        return redirect('/statelist');*/
        $errors="";
          $msg ="saved success.";
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
      
       
         return  view('admin.statelist');
    }

      public function state_datable(State $state)
    {
         $sql = \App\State::with(['country']);
       
          return Datatables::of($sql)
                ->editColumn('country_id', function(State $state) {
                    return  $state->country->country;
                })
                 ->editColumn('status',   function($data){
                        if($data->status == "Active"){
                           return  '<a href="javascript:;" class="btn default btn-xs blue status" data-status_id="'.$data->id.'"  data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                                   }else{

                            return    '<a href="javascript:;" class="btn default btn-xs red status" data-status_id="'.$data->id.'"" data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                               }  })
                ->addColumn('handle', function($data){
                            return '<a class="btn btn-danger" id="del_state" data-del_id='.$data->id.'> <i class="fa fa-trash"></i> </a>  
                              <a href="'.route('edit_state',Crypt::encrypt($data->id)).'"class="btn btn-warning" id="upd_country" > <i class="fa fa-edit"></i> </a> ';})
                ->rawColumns(['status','handle']) 
                ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,State $state,$id)
    {
       $ids=Crypt::decrypt($id);
        $edit=State::find($ids);
        return view('admin.addstate',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateUpdValidationRequest $request, State $state)
    {
        $state=$request->input('state');
        $status=$request->input('status');
        $country=$request->input('country');
        $uid=$request->input('id');
       
        $res=state::find($uid);
        $res->state=$state;
        $res->status=$status;
        $res->country_id=$country;
        $res->save();
          $errors="";
          $msg ="saved success.";
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);

    }
 public function status_update(Request $request, State $state)
    {
        $status=$request->input('status');
        $status_id=$request->input('status_id');
        $res=State::find($status_id);
        if ($status=="Active") {
            $res->status='Inactive';
            $res->save();
        }else{
            $res->status='Active';
            $res->save();

        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state,Request $request)
    {
        $del_id=$request->input('del_id');
        State::destroy('id',$del_id);
        $request->session()->flash('msg','Deleted');
        return redirect('statelist');
    }

      public function del_all(State $state,Request $request)
    {
        $del_id=$request->input('del_id');
       foreach ($del_id as $del_id) {
            state::destroy('id',$del_id);
       }
    }
}
