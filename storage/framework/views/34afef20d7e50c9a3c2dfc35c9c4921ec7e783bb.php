



<?php $__env->startSection('content'); ?>
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
        <?php $__currentLoopData = $attend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo e($name->user->name); ?> <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>
    
                    <div class="progress-group">
                   

                      <span class="float-right"><b><?php echo e($total_attend); ?></b>/<?php echo e($total_users); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($total_attend/$total_users * 100); ?>%"></div>
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
        <?php $__currentLoopData = $absentsNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo e($name); ?> <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>
                      <span class="float-right"><b><?php echo e($total_users-$total_attend); ?></b>/<?php echo e($total_users); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php echo e(($total_users-$total_attend)/$total_users*100); ?>%"></div>
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
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
         $lateTrue=false;
        $latetotal=$user->calc($user->id,$today,true); 
        if($latetotal >0){
        $lateTrue=true;
        }
        ?>
         <?php if($lateTrue): ?>  
          <tr>
          <td><?php echo e($LateNames[$user->id]); ?></td>
            <td><?php echo e($lateCalc[$user->id]); ?></td>
            <td><?php echo e($LateMints[$user->id]); ?></td>
          </tr>     
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<br>

                      <span class="float-right"><b><?php echo e($total_late); ?></b>/<?php echo e($total_users); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo e($total_late/$total_users * 100); ?>%"></div>
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

    <?php $__currentLoopData = $labels_late; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    new_labels.push("<?php echo e($lb); ?>");

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
  //  new_labels  = new_labels.replace('&#039;',"");

  console.log(new_labels.join(','));

                      var ctx = document.getElementById('myChart').getContext('2d');
                      var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels:new_labels,
                              datasets: [{
                                  label:'الأكثر تاخير',
                                  data: [<?php echo e($data_late); ?>],
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

    <?php $__currentLoopData = $labels_absent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    new_labels.push("<?php echo e($lb); ?>");

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
  //  new_labels  = new_labels.replace('&#039;',"");

  console.log(new_labels.join(','));

                      var ctx = document.getElementById('myChart2').getContext('2d');
                      var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels:new_labels,
                              datasets: [{
                                  label:'الأكثر غياب',
                                  data: [<?php echo e(implode(',',$data_absent)); ?>],
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
    <?php $__currentLoopData = $namesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

new_labels.push("<?php echo e($lb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $sickDaysList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
new_sickDaysList.push("<?php echo e($sb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $eteraryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
new_eteraryList.push("<?php echo e($sb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $e3tyadiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
new_e3tyadiList.push("<?php echo e($sb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $offList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
new_offList.push("<?php echo e($sb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $wafaaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
new_wafaaList.push("<?php echo e($sb); ?>");

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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
            
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/admin/adminhome.blade.php ENDPATH**/ ?>