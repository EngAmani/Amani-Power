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

<form method="POST" action="{{ route('fileUpload') }} " enctype="multipart/form-data">
     @csrf

     @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif



          <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            
            <div class="card-header">
            
            </div>
                  <div class="card-body" style="display: block;">
                  <label>نوع الاجازة</label>
                  <select name="title" class="form-control" id="post-title"> 
                  <option selected="true" value="">--أختر نوع الاجازة--</option>
                      <option value="اعتيادي">اعتيادي</option>
                      <option value=" مرضي"> مرضي</option>
                      <option value=" اضطراري"> اضطراري</option>
                      <option value=" مهمة رسمية"> مهمة رسمية</option>
                      <option value=" وفاة">وفاة </option>
                      
      
                  </select>
                                  </div>
                            <div class="form-group">
                            <div class="card-body" style="display: block;">
                            <label>بداية الإجازة</label>
                      <input type="date" name="start" class="form-control" id="start" value="{{now()->format('Y-m-d')}}">
                            </div>
                            </div>
                      <div class="form-group">
                      <div class="card-body" style="display: block;">
                      <label>نهاية الإجازة</label>
                <input type="date" name="end" class="form-control" id="end" value="{{now()->format('Y-m-d')}}">
                      </div>
                      </div>
              <div class="form-group">
              <div class="custom-file">
              <div class="card-body" style="display: block;">

                        <label  for="chooseFile"> إرفاق ملف</label>
                      <br>
                        <input type="file" name="file"  id="chooseFile">
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













<!-- 




          <div class="form-group absent-input">
        <label>نوع الاجازة</label>
            <select name="title" class="form-control" id="post-title"> 
            <option selected="true" value="">--أختر نوع الاجازة--</option>
                <option value="اعتيادي">اعتيادي</option>
                <option value=" مرضي"> مرضي</option>
                <option value=" اضطراري"> اضطراري</option>
                <option value=" مهمة رسمية"> مهمة رسمية</option>
                <option value=" وفاة">وفاة </option>
                
 
            </select>
        </div>

          <div class="form-group ">
        <label>بداية الإجازة</label>
        <input type="date" name="start" class="form-control" id="start" value="{{now()->format('Y-m-d')}}">
        </div>

        <div class="form-group ">
        <label>نهاية الإجازة</label>
        <input type="date" name="end" class="form-control" id="end" value="{{now()->format('Y-m-d')}}">
        </div>

            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">إرفاق ملف</label>
            </div>

     <br><br>


        <button type="submit" class="btn btn-success">إرسال</button> -->

     </form>

@endsection
