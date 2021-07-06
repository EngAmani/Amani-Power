

<?php $__env->startSection('content'); ?>
 
 <?php echo $__env->make('sweet::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<label> إدارة ورديات الموظفين  </label>

<table style="direction:rtl" id="x" class="table table-striped mt-3">
  <thead>
    <tr>
  
      <th scope="col">اسم الموظف</th>
      <th scope="col">مسمى فترة الدوام</th>
      <th scope="col">وقت الحضور</th>
      <th scope="col">وقت الإنصراف</th>
      <th scope="col">تعديل حذف</th>

    </tr>
  </thead>
  <tbody>

<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   
      
      <?php $global_format = env("GLOBAL_DATE_FORMAT","d-m-Y"); ?>

    <td><?php echo e($user->name); ?></td>
    <?php $__currentLoopData = $user->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<td><?php echo e($shift->title); ?></td>
<td><?php echo e($shift->from); ?></td>
<td><?php echo e($shift->to); ?></td>

 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<td>
    <a href="#" class="btn btn-primary" style="background-color:009F93; color:white;">
      <i class="fa fa-pencil"></i>
    </a>

     
    <a href="deleteShiftForEmployee/<?php echo e($user->id); ?>" class="btn btn-danger" style="background-color:7399C6; color:white;">
      <i class="fa fa-trash"></i>
    </a>

      


      </td>
 
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/admin/shifts/table.blade.php ENDPATH**/ ?>