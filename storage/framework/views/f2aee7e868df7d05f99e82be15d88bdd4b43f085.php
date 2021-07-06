<?php $__env->startSection('content'); ?>

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
                <td><?php echo e(auth()->user()->name); ?></td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
                <th>الإدارة:</th>
                <td><?php echo e(auth()->user()->Administration); ?></td>
            </tr>
      

            <tr>
                <th>الرقم الوظيفي:</th>
                <td><?php echo e(auth()->user()->amana_id); ?></td>
                
            </tr>

          

            


           
        </table> -->

        <table style="width:100%;">
  <tr>
    <th class="headtext">الموظف:</th>

    <th class="headtext">الإدارة:</th>
    <th class="headtext"> الرقم الوظيفي:</th>

  </tr>
  
      

  <tr>

    <td><?php echo e(auth()->user()->name); ?></td>
    <td><?php echo e(auth()->user()->Administration); ?></td>
    <td><?php echo e(auth()->user()->amana_id); ?></td>
  </tr>

</table>

                   </div>


                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                  
                  <?php if(Auth::user()->passedLimit()): ?>
                        <h6 style=" width: 100%; text-align: center;">لقد تجاوزت الحد المسموح للحضور و الانصراف</h6>
                  <?php endif; ?>
                    <?php if(!auth()->user()->isCheckedIn() && !Auth::user()->passedLimit()): ?>
                    <form method="POST" action="<?php echo e(route('store')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" style=" width: 100%; text-align: center;" class="btn btn-success">حضور</button>
                      
                      </form>
                      <?php endif; ?>
                        <?php if(auth()->user()->isCheckedIn() && !Auth::user()->passedLimit()): ?>
                      <form method="POST" action="<?php echo e(route('update')); ?>" >
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <button type="submit" style=" width: 100%; text-align: center;"  class="btn btn-success">إنصراف</button>
                      
                      </form>
                      <?php endif; ?>



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
  
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <tr>

    <td ><?php echo e($post->time_in); ?></td>
    <td><?php echo e($post->time_out); ?></td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>


                </div>

   
             

                
            </div>
             
            <!-- <br></br> -->
        </div>
     
    </div>

    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/user/home.blade.php ENDPATH**/ ?>