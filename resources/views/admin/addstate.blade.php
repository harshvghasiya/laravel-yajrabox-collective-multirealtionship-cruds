@extends('admin.layout')
@if(isset($edit))

@section('title','Edit State')

@else

@section('title','Add State')

@endif

@section('container')
<div class="page-content">
  @if(Session::has('msg'))
    <div class="alert alert-warning" role="alert">
        {{session('msg')}} </div>
    @endif
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        @if(isset($edit))

    <div class="page-title">
            <h1>Edit State </h1>
        </div>

       @else

      <div class="page-title">
            <h1>Add State </h1>
        </div>

       @endif
       
        <!-- END PAGE TITLE -->

    </div>


    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
              @if(isset($edit))
            <div class="caption">
                <i class="fa fa-gift"></i> Edit State
            </div>
              @else
            <div class="caption">
                <i class="fa fa-gift"></i> Add State
            </div>
             @endif
            
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="" class="reload">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            @if(isset($edit))
           {{Form::model($edit, ['route' => ['upd_state', $edit],
                                   'id' =>'stateValidation',
                          'class'=>'FromSubmit',
                          'method'=>'put',
                          'redirect_url' =>route('stateListMain')])}}

            @else
           
            {!! Form::open(['route' => 'statestore',
                            'id' =>'stateValidation',
                          'class'=>'FromSubmit',
                          'redirect_url' =>route('stateListMain')]) !!}
            @endif   
                <div class="form-body">
                <div class="form-group">
                    <label>Country</label>
                 @if(isset($edit))
                {{ Form::select('country',[$edit->country->id=>$edit->country->country]+ \App\State::getCountryDropdown(),null,['id'=>'',"class"=>"form-control js-example-placeholder-single js-states"])
                 }}   
                  @else
                   {{ Form::select('country',[''=>'--Select--']+ \App\State::getCountryDropdown(),null,['id'=>'',"class"=>"form-control js-example-placeholder-single js-states"])
                 }}  
                 @endif
                </div>
                    <div class="form-group">
                        <label>State</label>
                        <div class="input-group input-icon right">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <i class="fa fa-exclamation tooltips" data-original-title="Invalid email."
                                data-container="body"></i>
                                {{Form::text('state',old('state'),['id'=>'country', 'class'=>'input-error form-control','placeholder'=>'State'])}}
                                  {{Form::text('id',old('state'),['id'=>'country', 'class'=>'input-error hidden form-control','placeholder'=>'State'])}}
                          
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label>Status</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                {{ Form::radio('status', 'Active', true, ['id'=>'optionsRadios4'])}}
                              Active
                            <label class="radio-inline">

                                 {{ Form::radio('status', 'InActive',null ,['id'=>'optionsRadios5'])}}
                           InActive
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-info">Submit</button>
                    <a href="{{url('/statelist')}}" type="button" class="btn default">Cancel</a>
                </div>
                    {!! Form::close() !!}
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->


</div>


@endsection