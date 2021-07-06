

<?php $__env->startSection('content'); ?>
 
 <?php echo $__env->make('sweet::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
<div class="col-lg-6 mx-auto">
    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

<form method="POST" action="<?php echo e(route('stor_excuses')); ?>">
     <?php echo csrf_field(); ?>


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
        <input type="date" name="date" class="form-control" id="post-date" value="<?php echo e(now()->format('Y-m-d')); ?>">
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
        <input type="date" name="date" class="form-control" id="post-date" value="<?php echo e(now()->format('Y-m-d')); ?>">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/user/excuses.blade.php ENDPATH**/ ?>