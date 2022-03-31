  <div class="form-group">
      <label>Area</label>
      <select class="form-control area" name="area" value="{{old('area')}}">
          <option>--Select--</option>



          @foreach($area_list as $result)
          <option value="{{$result->id}}">{{$result->area}}</option>

          @endforeach
      </select>
  </div>
  @error('area')
  <div class="form-group">
      <p class="form-control-static text-danger">
          {{$message}}
      </p>
  </div>
  @enderror