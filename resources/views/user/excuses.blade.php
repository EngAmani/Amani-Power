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

<form method="POST" action="{{ route('stor_excuses') }}">
     @csrf


     <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            
            <div class="card-header">
            
            </div>
                  <div class="card-body" style="display: block;">
                  <label>نوع الاستئذان</label>
            <select name="reason" class="form-control" id="post-reason"> 
            <option selected="true" value="">--أختر نوع الاستئذان--</option>
                <option value="استئذان ظروف خاصة">استئذان ظروف خاصة</option>
                <option value="استئذان مدارس">استئذان مدارس</option>
                <option value="استئذان مستشفى">استئذان مستشفى</option>
                <option value="استئذان مهمة رسمية">استئذان مهمة رسمية</option>
 
            </select>
                                  </div>
                            <div class="form-group">
                            <div class="card-body" style="display: block;">
                            <label>تاريخ الاستئذان</label>
        <input type="date" name="date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
                            </div>
                            </div>
                      <div class="form-group">
                      <div class="card-body" style="display: block;">
                      <label>يبداء الاستئذان من الساعة</label>
        <input type="time" name="from" step="2" class="form-control" id="from" >
                      </div>
                      </div>
              <div class="form-group">
              <div class="custom-file">
              <div class="card-body" style="display: block;">

              <label>ينتهي الاستئذان عند الساعة</label>
        <input type="time" name="to" step="2"class="form-control" id="to" >
                        <!-- class="custom-file-input"
                        class="custom-file-label" -->

                </div>  

            </div>

              </div>
              <button type="submit" class="btn btn-success">إرسال</button>

            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
















    
     <!-- <div class="form-group absent-input">
        <label>نوع الاستئذان</label>
            <select name="reason" class="form-control" id="post-reason"> 
            <option selected="true" value="">--أختر نوع الاستئذان--</option>
                <option value="استئذان ظروف خاصة">استئذان ظروف خاصة</option>
                <option value="استئذان مدارس">استئذان مدارس</option>
                <option value="استئذان مستشفى">استئذان مستشفى</option>
                <option value="استئذان مهمة رسمية">استئذان مهمة رسمية</option>
 
            </select>
        </div>


        <div class="form-group ">
        <label>تاريخ الاستئذان</label>
        <input type="date" name="date" class="form-control" id="post-date" value="{{now()->format('Y-m-d')}}">
        </div>


        <div class="form-group ">
        <label>يبداء الاستئذان من الساعة</label>
        <input type="time" name="from" step="2" class="form-control" id="from" >
        </div>

        <div class="form-group ">
        <label>ينتهي الاستئذان عند الساعة</label>
        <input type="time" name="to" step="2"class="form-control" id="to" >
        </div>

     


        <button type="submit" class="btn btn-success">إرسال</button> -->

     </form>

@endsection
