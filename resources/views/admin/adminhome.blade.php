@extends('layouts.admin')
@extends('layouts.app')


@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<div class="row">

<div class="col-sm-12 text-center p-6">
                    <p class="text-center">
                      <strong>تقارير اليوم</strong>
                    </p>
    
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  الحضور
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> المتواجدون الان</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach ( $attend as $name )
          {{$name->user->name}} <br>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>
    
                    <div class="progress-group">
                   

                      <span class="float-right"><b>{{$total_attend}}</b>/{{$total_users}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{$total_attend/$total_users * 100}}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->


<!-- start absents model and section !------------------------------------------------------------>
                    <div class="progress-group">
                     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
  الغياب
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> الغياب اليوم</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach (  $absentsNames as $name )
          {{$name}} <br>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>
                      <span class="float-right"><b>{{$total_users-$total_attend}}</b>/{{$total_users}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{($total_users-$total_attend)/$total_users*100}}%"></div>
                      </div>
                    </div>
<!-- end absents model and section !------------------------------------------------------------>
<!-- start late model and section !------------------------------------------------------------>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
التاخير</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> المتاخرون اليوم</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <table style="width:100%">
          <tr>
            <th>الموظف</th>
            <th>ساعة</th>
            <th>دقيقة</th>
          </tr>
        @foreach ( $users as $user )
        <?php 
         $lateTrue=false;
        $latetotal=$user->calc($user->id,$today,true); 
        if($latetotal >0){
        $lateTrue=true;
        }
        ?>
         @if ($lateTrue)  
          <tr>
          <td>{{$LateNames[$user->id]}}</td>
            <td>{{$lateCalc[$user->id]}}</td>
            <td>{{$LateMints[$user->id]}}</td>
          </tr>     
          @endif
        @endforeach
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>

                      <span class="float-right"><b>{{ $total_late}}</b>/{{ $total_users}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: {{ $total_late/$total_users * 100}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <!-- /.progress-group -->
                  </div>
        </div>


<!-- end late model and section !------------------------------------------------------------>



        <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" style="float:right;">
                  <i class="fas fa-bullhorn"></i>
مؤشرات الآداء خلال الشهر الحالي
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                

        <div class="cards2" style="width:100%">
<div class="card" id="card-2"  style="    width: 45%;
    display: inline-block !important;
    ">
                    <div class="chart-canvas"   >
          <canvas id="myChart" width="600" height="300"></canvas>
    <script >


    var new_labels = [];

    @foreach($labels_late as $lb)

    new_labels.push("{{$lb}}");

    @endforeach
    
  //  new_labels  = new_labels.replace('&#039;',"");

  console.log(new_labels.join(','));

                      var ctx = document.getElementById('myChart').getContext('2d');
                      var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels:new_labels,
                              datasets: [{
                                  label:'الأكثر تاخير',
                                  data: [{{$data_late}}],
                                  backgroundColor: [
                                      'rgba(79, 38, 131, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                  ],
                                  borderColor: [
                                      'rgba(79, 38, 131, 1))',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                  ],
                                  borderWidth: 1
                              }]
                          },
                          options: {
                            title:{display:true, text:'الموظفات الأكثر تأخير', fontSize:25},
                            maintainAspectRatio: false,
                       responsive:true,
                       scales: {
                           yAxes: [{
                               ticks: {
                                   beginAtZero: true
                               },       scaleLabel: {
        display: true,
        labelString: 'عدد الساعات'
      }
                           }]
                       }
                      }
                      });
</script>

                    </div>

          
          

                  </div>

                  <div class="card" id="card-1" style="    width: 45%;
    display: inline-block !important;
    float: left;">
                    <div class="chart-canvas"   >
          <canvas id="myChart2" width="600" height="300"></canvas>
    <script >

    var new_labels = [];

    @foreach($labels_absent as $lb)

    new_labels.push("{{$lb}}");

    @endforeach
    
  //  new_labels  = new_labels.replace('&#039;',"");

  console.log(new_labels.join(','));

                      var ctx = document.getElementById('myChart2').getContext('2d');
                      var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels:new_labels,
                              datasets: [{
                                  label:'الأكثر غياب',
                                  data: [{{implode(',',$data_absent)}}],
                                  backgroundColor: [
                                      'rgba(79, 38, 131, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                  ],
                                  borderColor: [
                                      'rgba(79, 38, 131, 1))',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                      'rgba(0, 170, 184, 1)',
                                  ],
                                  borderWidth: 1
                              }]
                          },
                          options: {
                            title:{display:true, text:'الموظفات الأكثر غياب بدون عذر', fontSize:25},
                            maintainAspectRatio: false,
                       responsive:true,
                       scales: {
                           yAxes: [{
                               ticks: {
                                   beginAtZero: true
                               },       scaleLabel: {
        display: true,
        labelString: 'عدد الايام'
      }
                           }]
                       }
                      }
                      });
</script>

                    </div>
                  
                    </div>




                    <div class="card" id="card-1" style="    width: 45%;
    display: inline-block !important;
    float: left;">
                    <div class="chart-canvas"   >
          <canvas id="myChart3" width="600" height="300"></canvas>
    <script >

    var new_labels = [];
    var new_sickDaysList = [];
    var new_eteraryList = [];
    var new_e3tyadiList = [];
    var new_offList = [];
    var new_wafaaList = [];
    @foreach($namesList as $lb)

new_labels.push("{{$lb}}");

@endforeach

@foreach($sickDaysList as $sb)
new_sickDaysList.push("{{$sb}}");

@endforeach

@foreach($eteraryList as $sb)
new_eteraryList.push("{{$sb}}");

@endforeach

@foreach($e3tyadiList as $sb)
new_e3tyadiList.push("{{$sb}}");

@endforeach

@foreach($offList as $sb)
new_offList.push("{{$sb}}");

@endforeach

@foreach($wafaaList as $sb)
new_wafaaList.push("{{$sb}}");

@endforeach


  console.log(new_labels.join(','));
  console.log(new_sickDaysList.join(','));
  console.log(new_eteraryList.join(','));
  console.log(new_e3tyadiList.join(','));
  console.log(new_offList.join(','));
  console.log(new_wafaaList.join(','));




                      var ctx = document.getElementById('myChart3').getContext('2d');
                      var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels:new_labels,
                                datasets: [
                                    {
                                      label: 'مرضي',
                                      data:new_sickDaysList,
                                      backgroundColor: '#D6E9C6',
                                    },
                                    {
                                      label: 'اعتيادي',
                                      data:new_e3tyadiList,
                                      backgroundColor: '#FAEBCC',
                                    },
                                    {
                                      label: 'اضطراري',
                                      data:new_eteraryList,
                                      backgroundColor: '#EBCCD1',
                                    },
                                    {
                                      label: 'مهمة رسمية',
                                      data:new_offList,
                                      backgroundColor: '#EBAAD1',
                                    },{
                                      label: 'وفاة',
                                      data:new_wafaaList,
                                      backgroundColor: '#EBAAD1',
                                    }
                                  ]
                          },
                          options: {
                            scales: {
                              xAxes: [{ stacked: true }],
                              yAxes: [{ stacked: true ,
                              
                                ticks: {
                beginAtZero: true,
                
            },  scaleLabel: {
        display: true,
        labelString: 'عدد الايام'
      }
                              
                              }],
                            },
                            title:{display:true, text:'الموظفات الأكثر تغيبًا', fontSize:25},
                            maintainAspectRatio: false,
                       responsive:true,
                      
                      }
                      });
</script>

                    </div>
                  
                    </div>




















              <!-- /.card-body -->
            </div>
            
@endsection


