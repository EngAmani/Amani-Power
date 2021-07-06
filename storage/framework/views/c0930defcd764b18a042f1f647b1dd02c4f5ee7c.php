

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

<form method="POST" action="<?php echo e(route('storeShiftUser')); ?>">
     <?php echo csrf_field(); ?>


    
     <div class="form-group mb-3 absent-input">
        <label>اختيار الفترة</label>
      
         <select name = "shifts">
         <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->title); ?></option>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </select>

        </div>


        <div class="form-group employeeList">
        <label>اختيار موظفين للفترة</label>
        <br>
        <input type="checkbox" name="all">
                 <label for="all">اختيار الكل</label><br>
         <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <input type="checkbox" name="user[]" value="<?php echo e($user->id); ?>">
                 <label for="<?php echo e($user->id); ?>"> <?php echo e($user->name); ?></label><br>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
        </div>

      
     

   <div class="form-group-mb-3"></div>
        <button type="submit" name="save_multiple_checkbox" class="btn btn-success">إرسال</button>

     </form>



     <div class="form-group deleteShift">
        <form method="POST" action="<?php echo e(route('deleteShift')); ?>">
        <?php echo csrf_field(); ?>
        <label>حذف فترة الدوام لجميع الموظفين</label>
        
        <div class="form-group-mb-3"></div>
        <button type="submit" name="save_multiple_checkbox" class="btn btn-success">حذف الفترة للجميع</button>
           </form>
       
        </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/admin/shifts/userShift.blade.php ENDPATH**/ ?>