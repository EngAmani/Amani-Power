@extends('layouts.app')

@section('content')
 
 @include('sweet::alert')

<div class="container text-center">
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
</div>


<h1>{{$shift->title}}</h1>
<div class="row">
<div class="col-md-4">
    <h3>الموظفين</h3>
        @foreach($shift->users as $user)
            <p>{{$user->name}} <a href="{{route('unassign-shift',[$user->id,$shift->id])}}">Delete</a></p>
        @endforeach
    </div>

    <div class="col-md-8">
        <h3>معلومات الدوام</h3>
        <h5>الفترة: {{$shift->from}} - {{$shift->to}}</h5>
        <h5>تاريخ البداية: {{$shift->start_date}}</h5>
        <h5>تاريخ النهاية: {{$shift->end_date}}</h5>
    </div>

</div>
</div>
@endsection
