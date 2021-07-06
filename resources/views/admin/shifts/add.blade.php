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

<form method="POST" action="{{ route('store_shift') }}">
     @csrf
     <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">اضافة فترة</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="form-group">
                <label for="title">مسمى الفترة</label>
                <input type="text" id="title" name="title" class="form-control">
              </div>
              <div class="form-group">
                <label for="start_date">تاريخ البداية</label>
                <input type="date" name="start_date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
              </div>
              <div class="form-group">
              <label>تاريخ النهاية</label>
              <input type="date" name="end_date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
                
              </div>
              <div class="form-group">
                <label for="from">بداية الدوام</label>
                <input type="time" name="from" step="2" class="form-control" id="from" >
              </div>
              <div class="form-group">
                <label for="to">نهاية الدوام</label>
                <input type="time" name="to" step="2" class="form-control" id="to" >
              </div>
            </div>
            <!-- /.card-body -->
            <button type="submit" class="btn btn-success">إرسال</button>
            
          </div>
          <!-- /.card -->
        </div>

      </div>

    
     <!-- <div class="form-group absent-input">
        <label>مسمى الفترة</label>
        <input type="text" name="title" class="form-control" id="title">
        </div>


        <div class="form-group ">
        <label>تاريخ البداية</label>
        <input type="date" name="start_date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
        </div>

        <div class="form-group ">
        <label>تاريخ النهاية</label>
        <input type="date" name="end_date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
        </div>

        <div class="form-group ">
        <label>بداية الدوام</label>
        <input type="time" name="from" step="2" class="form-control" id="from" >
        </div>

        <div class="form-group ">
        <label>نهاية الدوام</label>
        <input type="time" name="to" step="2"class="form-control" id="to" >
        </div> -->

     


        

     </form>

@endsection
