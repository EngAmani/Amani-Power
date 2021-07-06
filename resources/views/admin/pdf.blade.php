@extends('layouts.app')

@section('content')
 
 @include('sweet::alert')

<div class="row">
<div class="col-lg-6 mx-auto">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

<form method="POST" action="{{ route('generatPDF') }}">
     @csrf


     <!-- <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">Alabama</option>
                    <option data-select2-id="17">Alaska</option>
                    <option data-select2-id="18">California</option>
                    <option data-select2-id="19">Delaware</option>
                    <option data-select2-id="20">Tennessee</option>
                    <option data-select2-id="21">Texas</option>
                    <option data-select2-id="22">Washington</option>
                  </select> -->
                  <div class="col-md-6" data-select2-id="14">
                <div class="form-group" data-select2-id="13">
                 
                  <span class="select2 select2-container select2-container--bootstrap4 select2-container--below select2-container--open select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-disabled="false" aria-labelledby="select2-vlt7-container" aria-owns="select2-vlt7-results" aria-activedescendant="select2-vlt7-result-ow39-California"><span class="select2-selection__rendered" id="select2-vlt7-container" role="textbox" aria-readonly="true" title="California">  <br> </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                </div>
              
  

        <div class="form-group ">
        <label>الشهر</label>
 
        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="month" id="month" style=" max-height:250px;
    overflow:scroll;
    overflow-x:hidden;
    overflow-y:auto;
    margin-top:0px;width:100%;">
          @foreach($months as $month)
            <option value="{{$month}}">{{$month}}</option>
          @endforeach
        </select>
        </div>

        <!-- <div class="form-group ">
        <label>الى </label>
        <input type="date" name="pdf_to" class="form-control" id="pdf_to" value="{{now()->format('Y-m-d')}}">
        </div> -->

        
        <div class="form-group employeeList">
        <label>الموظف</label>
        <br>
        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="user" id="user"  style="width:100%;">

         @foreach($users as $user)
                   <option value="{{$user->id}}">{{$user->name}}</option>
           @endforeach

</select>
       
        </div>


        <button type="submit" class="btn btn-success">عرض التقرير</button>

     </form>

@endsection
