@extends('layouts.app')

@section('content')

<div class="container">
            
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            <span class="userInfo" style="  font-weight: bold;
color:#4f2683" >بياناتي</span>
             <div class="card-header">
             
             <!-- <table class="userInfo" id="infoTable">
            <tr>
                <th>الموظف:</th>
                <td>{{auth()->user()->name}}</td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
                <th>الإدارة:</th>
                <td>{{auth()->user()->Administration}}</td>
            </tr>
      

            <tr>
                <th>الرقم الوظيفي:</th>
                <td>{{auth()->user()->amana_id}}</td>
                
            </tr>

          

            


           
        </table> -->

        <table style="width:100%;">
  <tr>
    <th class="headtext">الموظف:</th>

    <th class="headtext">الإدارة:</th>
    <th class="headtext"> الرقم الوظيفي:</th>

  </tr>
  
      

  <tr>

    <td>{{auth()->user()->name}}</td>
    <td>{{auth()->user()->Administration}}</td>
    <td>{{auth()->user()->amana_id}}</td>
  </tr>

</table>

                   </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                  @if(Auth::user()->passedLimit())
                        <h6 style=" width: 100%; text-align: center;">لقد تجاوزت الحد المسموح للحضور و الانصراف</h6>
                  @endif
                    @if(!auth()->user()->isCheckedIn() && !Auth::user()->passedLimit())
                    <form method="POST" action="{{ route('store') }}">
                        @csrf
                        <button type="submit" style=" width: 100%; text-align: center;" class="btn btn-success">حضور</button>
                      
                      </form>
                      @endif
                        @if(auth()->user()->isCheckedIn() && !Auth::user()->passedLimit())
                      <form method="POST" action="{{ route('update')}}" >
                        @csrf
                        @method('PUT')
                        <button type="submit" style=" width: 100%; text-align: center;"  class="btn btn-success">إنصراف</button>
                      
                      </form>
                      @endif



                </div>

   
              

                
            </div>
        </div>
     
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<!-- <br></br> -->
            <!-- <span class="userInfo" ></span> -->
             <div class="card-header">
             
           

                <div class="card-body" style=" 	background: linear-gradient(45deg, #49a09d, #5f2c82); color:#FAF7FB;">
                    

                <table style="width:100%;  margin-left: auto;
  margin-right:100px;">
  <tr>
    <th>الحضور</th>

    <th>الانصراف</th>
  </tr>
  
@foreach ($posts as $post )

  <tr>

    <td >{{$post->time_in}}</td>
    <td>{{$post->time_out}}</td>
  </tr>
  @endforeach

</table>


                </div>

   
             

                
            </div>
             
            <!-- <br></br> -->
        </div>
     
    </div>

    
</div>
@endsection
