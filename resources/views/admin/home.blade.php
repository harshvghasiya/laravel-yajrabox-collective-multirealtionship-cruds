@extends('admin.layout')
@section('title','Country List')
@section('container')
<div class="page-content">
   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat2">
      <a href="{{url('countrylist')}}">
        <div class="display">
          <div class="number">
            <div class="icon">
              <i class="fa fa-paper-plane-o" aria-hidden="true"></i> <small>Country List Module</small>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat2">
      <a href="{{url('statelist')}}">
        <div class="display">
          <div class="number">
            <div class="icon">
              <i class="icon-diamond" aria-hidden="true"></i> <small>State List Module</small>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat2">
      <a href="{{url('arealist')}}">
        <div class="display">
          <div class="number">
            <div class="icon">
              <i class="icon-rocket" aria-hidden="true"></i> <small>Area List Module</small>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  

    <!-- END PAGE CONTENT-->
</div>

@endsection
@section('script')


@endsection