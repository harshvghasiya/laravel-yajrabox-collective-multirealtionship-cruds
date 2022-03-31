<?php

namespace App\Http\Controllers;
use App\Area;
use App\Country;
use App\Http\Requests\AreaUpdValidationRequest;
use App\Http\Requests\AreaValidationRequest;
use App\State;
use Illuminate\Http\Request;
use Crypt;
use Yajra\Datatables\Datatables;

class AreaController extends Controller
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
    public function create(Request $request,Area $area)
    {
               $country=Country::where('status','=','Active')->get();
               $state=state::where('status','=','Active')->get();
            
               return view('admin.createarea',compact('country','state'));  
    }

  public function stateshow(Request $request,Area $area)
    {
           $country_id=$request->input('country_id');
           return view('admin.state_show',compact('country_id'));  
    }

     public function upd_state_show(Request $request,Area $area)
    {
           $country_id=$request->input('country_id');

         $state_list=state::where([ ['country_id','=',$country_id],
                                    ['status','=','Active'] ])->get();

               return view('admin.upd_state_show',compact('state_list'));  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaValidationRequest $request,Area $area)
    {
       
        $res=new Area;
        $state_name=$request->input('state');
        $country_name=$request->input('country');
      
       
        $res->state_id=$request->input('state');
        $res->country_id=$request->input('country');
        $res->area=$request->input('area');
        $res->status=$request->input('status');
        $res->save();
        /*$request->session()->flash('msg','Area Added Successfully');
        return redirect('/arealist')*/
         $errors="";
          $msg ="saved success.";
        return response()->json(['success' => true,'msgs'=> $msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
     

        
        return view('admin.arealist');
    }

      public function area_datable(Area $area)
    {
        $sql=Area::with(['state']);
        return Datatables::of($sql)   
            ->editColumn('country_id', function(area $area) {
                    return  $area->state->country->country;
                })
             ->editColumn('state_id', function(area $area) {
                    return  $area->state->state;
                })
             ->editColumn('status',   function($data){
                        if($data->status == "Active"){
                           return  '<a href="javascript:;" class="btn default btn-xs blue status" data-status_id="'.$data->id.'"  data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                                   }else{

                            return    '<a href="javascript:;" class="btn default btn-xs red status" data-status_id="'.$data->id.'"" data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                               }  })
             ->addColumn('handle',function($data){
                return '<a class="btn btn-danger" id="del_area" data-del_id='.$data->id.'> <i class="fa fa-trash"></i> </a>  
                              <a href="'.route('edit_area',Crypt::encrypt($data->id)).'" class="btn btn-warning" id="upd_area" > <i class="fa fa-edit"></i> </a> ';
             })
             ->rawColumns(['status','handle'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area,Request $request,$id)
    {
          $ids=Crypt::decrypt($id);
         $edit=Area::find($ids);
        
        
        return view('admin.createarea',compact('edit'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdValidationRequest $request, Area $area)
    {

          $state=$request->input('state');
        $status=$request->input('status');
        $country=$request->input('country');
        $uid=$request->input('id');
        $area=$request->input('area');
       
        $res=Area::find($uid);
        $res->state_id=$state;
        $res->status=$status;
        $res->country_id=$country;
        $res->area=$area;
        $res->save();
        $errors="";
          $msg ="saved success.";
        return response()->json(['success' => true,'msgs'=> $msg, 'status'=>1,'errors' => $errors]);
    }

     public function status_update(Request $request, Area $area)
    {
         $status=$request->input('status');
        $status_id=$request->input('status_id');
        $res=Area::find($status_id);
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
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area,Request $request)
    {
        $del_id=$request->input('del_id');
        Area::destroy('id',$del_id);
        return redirect('arealist');
    }
      public function del_all(Area $area,Request $request)
    {
        $del_id=$request->input('del_id');
       foreach ($del_id as $del_id) {
            Area::destroy('id',$del_id);
       }
    }
}
