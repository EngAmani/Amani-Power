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

<form method="POST" action="{{ route('storeShiftUser') }}">
     @csrf


    
     <div class="form-group mb-3 absent-input">
        <label>اختيار الفترة</label>
      
         <select name = "shifts">
         @foreach($shifts as $shift)
            <option value="{{$shift->id}}">{{$shift->title}}</option>
           @endforeach
         </select>

        </div>


        <div class="form-group employeeList">
        <label>اختيار موظفين للفترة</label>
        <br>
        <input type="checkbox" name="all">
                 <label for="all">اختيار الكل</label><br>
         @foreach($users as $user)
             <input type="checkbox" name="user[]" value="{{$user->id}}">
                 <label for="{{$user->id}}"> {{$user->name}}</label><br>
           @endforeach
       
        </div>

      
     

   <div class="form-group-mb-3"></div>
        <button type="submit" name="save_multiple_checkbox" class="btn btn-success">إرسال</button>

     </form>



     <div class="form-group deleteShift">
        <form method="POST" action="{{ route('deleteShift') }}">
        @csrf
        <label>حذف فترة الدوام لجميع الموظفين</label>
        
        <div class="form-group-mb-3"></div>
        <button type="submit" name="save_multiple_checkbox" class="btn btn-success">حذف الفترة للجميع</button>
           </form>
       
        </div>



@endsection
