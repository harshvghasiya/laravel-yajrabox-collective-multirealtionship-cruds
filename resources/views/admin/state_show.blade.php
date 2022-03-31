  <div class="form-group">
      <label>State</label>

      {{ Form::select('state',[''=>'--Select--']+ \App\Area::getStateDropdown($country_id),null,['id'=>'',"class"=>"form-control js-example-placeholder-single js-states"])
         }}
      
  </div>
  