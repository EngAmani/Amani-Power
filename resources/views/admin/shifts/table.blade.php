@extends('layouts.app')

@section('content')
 
 @include('sweet::alert')

<label> إدارة ورديات الموظفين  </label>

<table style="direction:rtl" id="x" class="table table-striped mt-3">
  <thead>
    <tr>
  
      <th scope="col">اسم الموظف</th>
      <th scope="col">مسمى فترة الدوام</th>
      <th scope="col">وقت الحضور</th>
      <th scope="col">وقت الإنصراف</th>
      <th scope="col">تعديل حذف</th>

    </tr>
  </thead>
  <tbody>

@foreach($users as $user)
   
      
      <?php $global_format = env("GLOBAL_DATE_FORMAT","d-m-Y"); ?>

    <td>{{$user->name}}</td>
    @foreach($user->shifts as $shift)

<td>{{$shift->title}}</td>
<td>{{$shift->from}}</td>
<td>{{$shift->to}}</td>

 
@endforeach
<td>
    <a href="#" class="btn btn-primary" style="background-color:009F93; color:white;">
      <i class="fa fa-pencil"></i>
    </a>

     
    <a href="deleteShiftForEmployee/{{$user->id}}" class="btn btn-danger" style="background-color:7399C6; color:white;">
      <i class="fa fa-trash"></i>
    </a>

      


      </td>
 
    </tr>
@endforeach
  </tbody>
</table>


@endsection