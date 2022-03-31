@extends('admin.layout')
@section('container')
@if(isset($edit))

@section('title','Edit Country')

@else


@section('title','Add Country')



@endif


<div class="page-content ">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        @if(isset($edit))
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Edit Post </h1>
        </div>
        @else
         <div class="page-title">
            <h1>Add Post </h1>
        </div>
        @endif
        <!-- END PAGE TITLE -->

    </div>


    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            @if(isset($edit))
            <div class="caption">
                <i class="fa fa-gift"></i> Edit Country
            </div>
            @else
               <div class="caption">
                <i class="fa fa-gift"></i> Add Country
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
            {{Form::model($edit, ['route' => ['upd_country'],
                                   'id' =>'countryValidation',
                          'class'=>'FromSubmit',
                          
                          'redirect_url' =>route('countryListMain')])}}
            {{Form::text('id',null,['class'=>'input-error hidden form-control'])}}
                            
            @else
            {{Form::open(['route' => 'countrystore',
                         'id' =>'countryValidation',
                          'class'=>'FromSubmit',
                          'redirect_url' =>route('countryListMain')])}}
             @endif

  
                <div class="form-body">
                
                    <div class="form-group">
                        <label>Country</label>
                        <div class="input-group input-icon right">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <i class="fa fa-exclamation tooltips" data-original-title="Invalid email."
                                data-container="body"></i>
                                {{Form::text('country',old('country'),['id'=>'country',
                                                                       'placeholder'=>'Country',
                                                                        'class'=>'input-error form-control'])
                                }}
                                 
                        </div>
                    </div>
                

                    <div class="form-group">
                        <label>Status</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                {{Form::radio('status', 'Active', true)}}
                                
                                Active</label>
                            <label class="radio-inline">
                                    {{Form::radio('status', 'InActive', null)}}
                               
                               InActive </label>
                           
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info"> Submit</button>
                 
                    <a href="{{url('/')}}" type="button" class="btn default">Cancel</a>
                </div>
                {!! Form::close() !!}
             </form>
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->
</div>
@if(isset($edit))
@endsection
@else



@endsection

@endif
