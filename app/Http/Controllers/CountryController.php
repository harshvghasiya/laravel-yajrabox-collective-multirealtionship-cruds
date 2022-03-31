<?php

namespace App\Http\Controllers;

use App\country;
use Crypt;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CountryValidationRequest;
use App\Http\Requests\CountryUpdValidationRequest;

class CountryController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(country $country,CountryValidationRequest $request)
    {
        $input = $request->all();
        $errors = "";
       $res=new country;
       $res->country=$input['country'];
       $res->status=$input['status'];
       $res->save();
       // $request->session()->flash('msg','Country Added Successfully');
        $msg ="saved success.";
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);

       // return redirect('/countrylist');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(country $country)
    {
       
        return view('admin.countrylist');
    }



       public function country_datable(country $country)
    {
      
          return Datatables::of(Country::query())
                ->editColumn('status',   function($data){
                        if($data->status == "Active"){
                           return  '<a href="javascript:;" class="btn default btn-xs blue status" data-status_id="'.$data->id.'"  data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                                   }else{

                            return    '<a href="javascript:;" class="btn default btn-xs red status" data-status_id="'.$data->id.'"" data-status="'.$data->status.'">
                                        <i class="fa fa-edit"></i> '.$data->status.' </a>';
                               }  }) 
                    ->addColumn('handle', function($data){
                            return '<a class="btn btn-danger" id="del_country" data-del_id='.Crypt::encrypt($data->id).'> <i class="fa fa-trash"></i> </a>  
                              <a  href="'.route('edit_country',Crypt::encrypt($data->id)).'" class="btn btn-warning" id="upd_country" > <i class="fa fa-edit"></i> </a> ';
                        })
                
                ->rawColumns(['status','handle'])
            
                ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(country $country,Request $request,$id)
    {
        $ids=Crypt::decrypt($id);
        $edit=Country::find($ids);
        
        return view('admin.country',compact('edit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryUpdValidationRequest $request, country $country)
    {
         
         $uid=$request->input('id');
        $res=country::find($uid);
        $res->country= $request->input('country');
        $res->status=$request->input('status');
        $res->save();
        $errors="";
        $msg ="saved success.";
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);


    }
     public function  status_update(Request $request, country $country)
    {
         $status_id=$request->input('status_id');
        $res=Country::find($status_id);
       
        $status=$request->input('status');
        if ($status=='Active') {
            $res->status='InActive';
            $res->save();  
           
        }else{
           $res->status='Active';
            $res->save(); 
          
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(country $country,Request $request)
    {
        $id=$request->input('del_id');
         $del_id=Crypt::decrypt($id);
        Country::destroy('id',$del_id);
        $request->session()->flash('msg','Deleted Successfully');
        return redirect('countrylist');
    }

    public function del_all(country $country,Request $request)
    {
        $del_id=$request->input('del_id');
       foreach ($del_id as $del_id) {
            Country::destroy('id',$del_id);
       }
    }
}
