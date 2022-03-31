@extends('admin.layout')
@section('title','Country List')
@section('container')
<div class="page-content upd_append">
    @if(Session::has('msg'))
    <div class="alert alert-success" role="alert">
        {{session('msg')}} </div>
    @endif
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Manage Country <small>Post List</small></h1>
        </div>
        <!-- END PAGE TITLE -->

    </div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Manage Post
                </div>
                <div class="tools">

                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <a href="{{url('createarea')}}" class="btn btn-info">Add Area</a>
                 <button class="btn btn-danger" name="del_all" id="del_all">Delete</button>
                <div class="table-scrollable">
                    <table class="table table-hover" id="users-table">
                        <thead>
                            <tr>
                              
                                <th>
                                    Id
                                </th>
                                <th>
                                  Area Name
                                </th> 
                                <th>
                                  State Name
                                </th>
                                 <th>
                                   Country Name
                                </th>
                                <th>
                                   Status
                                </th>
                              <th>
                                   Handle
                                </th>
                              
                            </tr>
                        </thead>
                      
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->


    </div>


    <!-- END PAGE CONTENT-->
</div>

@endsection
@section('script')

<script src="http://code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
  
$(document).ready(function() {

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('area_datable') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'area', name: 'area' },
              { data: 'state_id', name: 'state_id'  },
            { data: 'country_id', name: 'country_id'  },
           
            { data: 'status', name: 'status' },
            { data: 'handle', name: 'handle' },
              
        ]
           
    });
});
</script>

<script type="text/javascript">
  $(document).on('click', '#del_area', function(event) {
    event.preventDefault();
    var del_id=$(this).data('del_id');
    var ele=this;
    $.ajax({
      url: '{{route('del_area')}}',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
      type: 'POST',
      
      data: {del_id: del_id},
      success:function(data){
        $(ele).closest('tr').fadeOut('slow');
      }
    });
    
  });

    $(document).on('click', '.status', function(event) {
      event.preventDefault();
      var status=$(this).data('status');
      var status_id=$(this).data('status_id');
      var op=$(this);

    $.ajax({
      url: '{{route('area_status')}}',
      type: 'POST',
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
       data: {status: status,
              status_id:status_id},
      success:function(data){
        if(status=='Active'){
           op.removeClass('blue');
           op.addClass('red');
           op.html('<i class="fa fa-edit"></i> InActive')
           op.data('status','Inactive');
        }else{
           op.removeClass('red');
           op.addClass('blue');
           op.html('<i class="fa fa-edit"></i> Active')
           op.data('status','Active');
        }
      }
      
    });
    
      
    });

       $(document).on('click', '#del_all', function(event) {
  event.preventDefault();
  var del_id=[];
  $(':checkbox:checked').each(function(i) {
    del_id[i]=$(this).val();

  });
  $.ajax({
    url: '{{route('area_del_all')}}',
    type: 'POST',
     headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
    data: {del_id: del_id},
    success:function(data){
      $('.del_check:checked').each(function() {
                   $(this).closest('tr').fadeOut('slow');
  });
    }

  });
  

});




</script>
<script type="text/javascript">
        
        $(document).on('change', '#upd_country', function() {
            
            var country_id=$(this).val();
            $.ajax({
                url: '{{route('upd_state_show')}}',
                type: 'POST',
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                data: {country_id: country_id },
                success:function(data){
                    $('.upd_state_show').html(data);
                }
            });         
        });

    </script>

@endsection