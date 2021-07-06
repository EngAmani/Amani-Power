

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

<form method="POST" action="<?php echo e(route('fileUpload')); ?> " enctype="multipart/form-data">
     <?php echo csrf_field(); ?>

     <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <strong><?php echo e($message); ?></strong>
            </div>
          <?php endif; ?>

          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <?php endif; ?>



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
                      <input type="date" name="start" class="form-control" id="start" value="<?php echo e(now()->format('Y-m-d')); ?>">
                            </div>
                            </div>
                      <div class="form-group">
                      <div class="card-body" style="display: block;">
                      <label>نهاية الإجازة</label>
                <input type="date" name="end" class="form-control" id="end" value="<?php echo e(now()->format('Y-m-d')); ?>">
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
        <input type="date" name="start" class="form-control" id="start" value="<?php echo e(now()->format('Y-m-d')); ?>">
        </div>

        <div class="form-group ">
        <label>نهاية الإجازة</label>
        <input type="date" name="end" class="form-control" id="end" value="<?php echo e(now()->format('Y-m-d')); ?>">
        </div>

            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">إرفاق ملف</label>
            </div>

     <br><br>


        <button type="submit" class="btn btn-success">إرسال</button> -->

     </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/user/leaves.blade.php ENDPATH**/ ?>