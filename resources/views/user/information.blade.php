@extends('layouts.app')

@section('content')


<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>






<!-- old continer -->

<div class="row container">
            <div class="col-6">
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">معلوماتي</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        

            <form method="GET" action="{{route('userInfo')}}">
    <select id="month" class="form-control" name="month" style="width:30%;display:inline-block;"> 
    @foreach($months as $month)
            <option value="{{$month}}">{{$month}}</option>
          @endforeach
            </select>
            <button   class="fas fa-search" type="submit" style="background-color:white;color:white ;display:inline-block; "></button>
            </form>
    <div id="window2" class="window">

           <?php 
           $month = null;
           if(request('month')){
              $month = request('month');
           }
          // dd($month);
            ?>
          <!-- <br></br>  -->
            <div id="pane1" class="pane">
                     <!-- التأخير: 
                    <br></br>
                     الاستئذان: 
                    <br></br>
                    الوقت الإضافي: {{$user->extraTime($user->id,$month)}}
                    <br></br>
                    رصيد الأجازات السنوي: 30 يوم
                    <br></br>
                    المتبقي من رصيد الإجازات السنوي:
                    <br></br>
                    الإجازات الإضطرارية: 
                    <br></br>
                    ايام الغياب: {{$user->absentCalculator($user->id,$month)}} -->

                    <table style="width:100%; border: 1px solid black;">
 
  <tr>
    <td>التاخير</td>
    <td>{{$user->calc($user->id,$month)}}</td>
  </tr>
  <tr>
    <td>الاستئذان</td>
    <td>{{$user->excusesHours($user->id,$month)}}</td>
  </tr>
  
   <tr>
    <td>الوقت الاضافي</td>
    <td>{{$user->extraTime($user->id,$month)}}</td>
  </tr>
  
   <tr>
    <td>رصيد الاجازة السنوية</td>
    <td>{{$user->annual_leave_calc($user->id,$month)}}</td>
  </tr>
  
   <tr>
    <td>رصيد الاجازة الاضطرارية</td>
    <td>{{$user->etraryCalc($user->id)}}</td>
  </tr>
  
   <tr>
    <td>ايام الغياب</td>
    <td>{{$user->absentCalculator($user->id,$month)}}</td>
  </tr>
</table>

            </div>
            </div>
            </div>
              <!-- /.card-body -->
              <?php $hoursData=[]; 
              $escuse=round(($user->excusesHours($user->id,$month,true))/60);
              $late=round(($user->calc($user->id,$month,true)/60));
              $offerTime=round(($user->extraTime($user->id,$month,true))/60);
              $hoursData=[$late,$escuse,$offerTime];
              
              $noDaysData=[];
              $absentDays=$user->absentCalculator($user->id,$month,true);
              $vacBalance=$user->annual_leave_calc($user->id,$month,true);
              $noDaysData=[$absentDays, $vacBalance];//3 needs to rep;ace with the real data!
             
              ?>
     
            </div>
          </div>
           

          <div class="card col-sm-6" id="bloc1">
              <div class="card-header"  style="background: linear-gradient(45deg, #49a09d, #5f2c82);">
                <h3 class="card-title"  style="color:white">جدول الحضور</h3>
<!-- 
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                    <th>التاريخ</th>
    <th>الحضور</th>
    <th>الانصراف</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
           $month = null;
           if(request('month')){
              $month = request('month');
              
              // $poatsFilter=app\Models\Post::all()->where('date',$month);

            $posts=$postsFilter;
           
           }
        
        
            ?>
                  @foreach ($posts as $post)
  <tr>
    <td>{{$post->date}}</td>
    <td>{{$post->time_in}}</td>
    <td>{{$post->time_out}}</td>
  </tr>
 @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
        </div>

<!-- test -->


<div class="row container">
            <div class="col-6">
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">رسومات بيانية</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        

           
    <div id="window2" class="window">

          
          
    <div id="pane2" class="pane">  
                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

                    <script>

var xValues = ["التاخير", "الإستئذان", "الوقت الإضافي"];
var yValues =  [{{implode(',',$hoursData)}}];
var barColors = ["rgba(79, 38, 131, 1)", "rgba(79, 38, 131, 1)","rgba(79, 38, 131, 1)"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "بيانات الموظف خلال الشهر/بالساعات"
    },  scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            },  scaleLabel: {
        display: true,
        labelString: 'عدد الساعات'
      }
        }]
    }
  }
});</script> 
                    
                    
                    <!-- </div>

    </div>
</div>
   
            </div>
              <!-- /.card-body -->
     
              </div></div>
              </div>
      


              <!-- /.card-body -->
              <?php $hoursData=[]; 
              $escuse=round(($user->excusesHours($user->id,$month,true))/60);
              $late=round(($user->calc($user->id,$month,true)/60));
              $offerTime=round(($user->extraTime($user->id,$month,true))/60);
              $hoursData=[$late,$escuse,$offerTime];
              
              $noDaysData=[];
              $absentDays=$user->absentCalculator($user->id,$month,true);
              $vacBalance=$user->annual_leave_calc($user->id,$month,true);
              $noDaysData=[$absentDays, $vacBalance];//3 needs to rep;ace with the real data!
             
              ?>
     
            </div>
          </div>
           

          <div class="card col-sm-6" id="bloc1">
              <div class="card-header"  >
                <h3 class="card-title" >رسومات بيانية</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
               


              <div id="pane2" class="pane">  
                    <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>

                    <script>

var xValues = ["الغياب", "رصيد الإجازات"];
var yValues =  [{{implode(',',$noDaysData)}}];
var barColors = ["rgba(79, 38, 131, 1)", "rgba(79, 38, 131, 1)","rgba(79, 38, 131, 1)"];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "بيانات الاجازات و الغياب خلال الشهر/الايام"
    },
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
                
            },  scaleLabel: {
        display: true,
        labelString: 'عدد الايام'
      }
         
        }]
    }
  }
  
});
</script> 
                    
                    
                    <!-- </div>

    </div>
</div>
   
            </div>
              <!-- /.card-body -->
     
            </div>
          </div>
          </div>










</body>

@endsection
