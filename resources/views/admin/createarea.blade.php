@extends('admin.layout')
@section('title','Add State')
@section('container')
<div class="page-content">
  @if(Session::has('msg'))
    <div class="alert alert-warning" role="alert">
        {{session('msg')}} </div>
    @endif
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Add State </h1>
        </div>
        <!-- END PAGE TITLE -->

    </div>


    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> Add State
            </div>
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
             {{Form::model($edit, ['route' => ['upd_area'],
                                   'id' =>'areaValidation',
                          'class'=>'FromSubmit', 
                          'redirect_url' =>route('areaListMain')])}}
          @else
            {!! Form::open(['route' => 'areastore',
                           'id' =>'areaValidation',
                          'class'=>'FromSubmit',
                    'redirect_url' =>route('areaListMain')]) !!}
          @endif 
                <div class="form-body">
                <div class="form-group">
                     
               <label>Country</label>
            @if(isset($edit))
              {{ Form::select('country',[$edit->state->country->id=>$edit->state->country->country]+ \App\State::getCountryDropdown(),null,['id'=>'country',"class"=>"form-control country js-example-placeholder-single js-states"])
              }}

            @else
               {{ Form::select('country',[''=>'--Select--']+ \App\State::getCountryDropdown(),null,['id'=>'country',"class"=>"form-control country js-example-placeholder-single js-states"])
                }}
            @endif          
                </div>
               

                  <div class="state_append">
                    @if(isset($edit))
                      <div class="form-group">

                           <label>State</label>

              {{ Form::select('state',[$edit->state->id=>$edit->state->state]+ \App\Area::getStateDropdown($edit->state->country_id),null,['id'=>'',"class"=>"form-control"])
                             }}
                     </div>
                     @endif
                  </div>

                    <div class="form-group">
                        <label>Area</label>
                        <div class="input-group input-icon right">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <i class="fa fa-exclamation tooltips" data-original-title="Invalid email."
                                data-container="body"></i>
                                {{Form::text('area',old('area'),['id'=>'country','class="input-error form-control','placeholder'=>'Area'])}}
                                 {{Form::text('id',null,['id'=>'id','class="input-error hidden form-control','placeholder'=>'Area'])}}
                           
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
                   <button type="submit" class="btn btn-info"> Submit</button>
                 
                    <a href="{{url('/arealist')}}" type="button" class="btn default">Cancel</a>
                </div>

            {!! Form::close() !!}
           
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->


</div>


@endsection
@section('script')
<script type="text/javascript">

      $(document).on('change', '.country', function() {
     
          var country_id=$(this).val();
       
         $.ajax({
             url: '{{route('state_show')}}',
             type: 'post',
             headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
             data: {

                country_id: country_id},
             success:function(data){
                $('.state_append').html(data);
             }

         });
         

      });



</script>

@endsection