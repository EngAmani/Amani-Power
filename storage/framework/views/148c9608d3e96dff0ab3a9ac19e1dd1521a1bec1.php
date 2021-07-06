

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

<form method="POST" action="<?php echo e(route('generatPDF')); ?>">
     <?php echo csrf_field(); ?>


     <!-- <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">Alabama</option>
                    <option data-select2-id="17">Alaska</option>
                    <option data-select2-id="18">California</option>
                    <option data-select2-id="19">Delaware</option>
                    <option data-select2-id="20">Tennessee</option>
                    <option data-select2-id="21">Texas</option>
                    <option data-select2-id="22">Washington</option>
                  </select> -->
                  <div class="col-md-6" data-select2-id="14">
                <div class="form-group" data-select2-id="13">
                 
                  <span class="select2 select2-container select2-container--bootstrap4 select2-container--below select2-container--open select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-disabled="false" aria-labelledby="select2-vlt7-container" aria-owns="select2-vlt7-results" aria-activedescendant="select2-vlt7-result-ow39-California"><span class="select2-selection__rendered" id="select2-vlt7-container" role="textbox" aria-readonly="true" title="California">  <br> </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                </div>
              
  

        <div class="form-group ">
        <label>الشهر</label>
 
        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="month" id="month" style=" max-height:250px;
    overflow:scroll;
    overflow-x:hidden;
    overflow-y:auto;
    margin-top:0px;width:100%;">
          <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($month); ?>"><?php echo e($month); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>

        <!-- <div class="form-group ">
        <label>الى </label>
        <input type="date" name="pdf_to" class="form-control" id="pdf_to" value="<?php echo e(now()->format('Y-m-d')); ?>">
        </div> -->

        
        <div class="form-group employeeList">
        <label>الموظف</label>
        <br>
        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="user" id="user"  style="width:100%;">

         <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>
       
        </div>


        <button type="submit" class="btn btn-success">عرض التقرير</button>

     </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\hrSystem\resources\views/admin/pdf.blade.php ENDPATH**/ ?>