<?php

namespace App\Http\Controllers;
use App\Country;
use App\State;
use App\Streat;
use App\Area;
use Illuminate\Http\Request;

class StreatController extends Controller
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
    public function create(Request $request,Streat $streat)
    {
        $country=country::where('status','=','Active')->get();
        return view('admin.createstreat',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Streat $streat)
    {
       $country=$request->input('country');
       $state=$request->input('state');
      $request->validate([
        'country'=>'required|integer',
        'state'=>'required|integer',
        'area'=>'required|integer',
        'streat'=>'required|unique:streats,streat'
      ]);
      $res=new Streat;
      $res->streat=$request->input('streat');
      $res->country_id=$country;
      $res->state_id=$state;
      $res->area_id=$request->input('area');
      $res->status=$request->input('status');
      $res->save();
      $request->session()->flash('msg','Streat Added Successfully');
      return redirect('/streatlist');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\streat  $streat
     * @return \Illuminate\Http\Response
     */
    public function show(streat $streat)
    {
             $streat=Streat::with(['area','country','state'])->get();
             return view('admin.streatlist',compact('streat'));

    }



      public function stateshow(streat $streat,Request $request)
    {
        $country_id=$request->input('country_id');

        $state_list=state::where([['country_id','=',$country_id],
                                   ['status','=','Active']])->get();
        return view('admin.state_show',compact('state_list'));
    }
      public function areashow(streat $streat,Request $request)
    {
        $state_id=$request->input('state_id');
      $country_id=$request->input('country_id');
  
        $area_list=Area::where([['state_id','=',$state_id],
                                ['country_id','=',$country_id],
                                   ['status','=','Active']])->get();
        
        return view('admin.area_show',compact('area_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\streat  $streat
     * @return \Illuminate\Http\Response
     */
    public function edit(streat $streat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\streat  $streat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, streat $streat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\streat  $streat
     * @return \Illuminate\Http\Response
     */
    public function destroy(streat $streat,Request $request)
    {
        $del_id=$request->input('del_id');
        streat::destroy('id',$del_id);
        return redirect('streatlist');
    }
}
