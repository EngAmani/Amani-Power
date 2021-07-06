<style>
#x td 
{
    text-align:center;
    vertical-align: middle;
}
td{
  text-align:center;
  direction: rtl;
}
th{
  text-align:center;
  direction: rtl;
}
#x {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
/* margin-left:80px; */
  direction: rtl;
  
}
h4{
  direction: rtl;
}
img{
  margin-right:620px;
  margin-bottom:10px;
  margin-top:0px;
  direction:rtl;
}
#x td, #x th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align:center;
}
#x tr:nth-child(even){background-color: #ffffff;}
#x tr:hover {background-color:#3F2986;}
#x th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #3F2986;
  color: white;
  direction: rtl;
}
</style>

<?php $name=[];?>
@foreach($posts as $post)
<?php
$name=$post->user->name?>
@endforeach



<style>
#tail td{
  border: 1px solid white;
 
  }
@page {
	header: page-header;
	footer: page-footer;
}
thead{display: table-header-group;}
tfoot {display: table-row-group;}
tr {page-break-inside: avoid;}
</style>

<htmlpageheader name="page-header">
<img src="C:\Users\eng_a\OneDrive\سطح المكتب\1045684.jpg" alt="امانة جدة" width="120" height="120">

<p style="font-weight: bold;  font-size: large;text-align:center;color:#000000;margin-top:-28px; float:center">بيان الحضور و الانصراف لشهر {{$monthAr}}</p>
<p style="text-align:left;color:#000000; margin-top:-8px;opacity: 0.8;float:left">

الموظفة:{{$userinfo->name}}  
<span style="color:white">--------------------------------------------------------------------</span>
  <span style="float:left;">
  إدارة المراقبة الإلكترونية لتتبع المركبات        </span> 

</p> 



</htmlpageheader>

<htmlpagefooter name="page-footer" >




<p style="text-align:left;color:#9a9a9a;">
ملخص الحضور و الإنصراف لموظفات مركز التحكم  
<span style="color:white">-------------------------------------------------------------</span>
  <span style="float:right;">
   الإدارة العامة للتحكم        </span> 
</p>
</htmlpagefooter>
<br></br>
<br></br><br></br>
<br></br><br></br>


<?php
$datel = \Carbon\Carbon::now();
$datel->startOfMonth()->subMonth()->format('F Y');

?>



<table id="x" class="table table-striped mt-3">
  <thead>
    <tr>
    
    <th style="width:1%;text-align:center;" scope="col">#</th>
      <th style="width: 22%;text-align:center;" scope="col">التاريخ</th>
      <th style="width: 22%;text-align:center;" scope="col">الحضور</th>
      <th style="width: 22%;text-align:center;"  scope="col">الانصراف</th>
      <th style="width: 22%;text-align:center;"  scope="col">التاخير</th>

   
    </tr>
  </thead>
  <tbody>
  <?php $counter=0; $global_format = env("GLOBAL_DATE_FORMAT","d-m-Y");
// dd($shiftStart,$shiftEnd);

  ?>




  @foreach($posts as $post)
    <tr>
 <?php $counter++;

 $attendOreginal=$post->time_in;
 $leaveOreginal=$post->time_out;
$hours=0;
$min=0;
$MorningLate=0;
$earlyOut=0;
 
 if($post->time_in!=null && $post->time_out!=null){
 $attend=new Carbon\Carbon($attendOreginal);
 $leave=new Carbon\Carbon($leaveOreginal);
 $ectendedTimeIn=new Carbon\Carbon('8:10:00');
 $ectendedTimeOut=new Carbon\Carbon('15:50:00');
 $shiftEnd=new Carbon\Carbon($shiftEnd);
 $shiftStart=new Carbon\Carbon($shiftStart);
 if($attend <= $shiftStart){
  $MorningLate=0;
 }
 if( $leave >= $shiftEnd){
  $earlyOut=0;
 }
 if($attend > $shiftStart){
   $MorningLate=$attend->diffInMinutes($shiftStart);
 }
 if($leave < $shiftEnd){
   $earlyOut=$shiftEnd->diffInMinutes($leave);
 }
$workinHoure=$shiftEnd->diffInHours($shiftStart);
$totalLate=$MorningLate+$earlyOut;

// dd($MorningLate,$earlyOut,$totalLate);
if($workinHoure>=7){
  // $shiftstart=$shiftStart->format("H:i:s");
  if($shiftStart==$ectendedTimeIn){
  
    if( $attend  >  $ectendedTimeIn){
      $totalLate=$totalLate+10;
    }
    // else{
    //   dd($totalLate);

    //   $totalLate=0;
    // }
  }//end extinting reqular normal shift


  if($shiftEnd== $ectendedTimeOut){
    if( $leave  <  $ectendedTimeOut){
      // dd($totalLate);
     


      $totalLate=$totalLate+10;

    }
    // else{
    //   $totalLate=0;
    // }

  }



}



 $hours=(int)($totalLate/60);
 $min= $totalLate%60;
 
 }
 elseif(empty($attendOreginal)){
  $attendOreginal="لايوجد بصمة دخول";
 }
 elseif(empty($leaveOreginal)){
  $leaveOreginal="لايوجد بصمة خروج";
 }
 ?>
    <!-- <th scope="row">{{ $post->id}}</th> -->
    <th scope="row"style="text-align:center; " class="table-buttons">
    {{$counter}}
     


</th>
    <td style="text-align:center;line-height: 14px;">{{ $post->date}}</td>


    <td style="text-align:center;line-height: 14px;">{{$attendOreginal}}</td>
    <td style="text-align:center;line-height: 14px;">{{$leaveOreginal}}</td>
    <style>
     .late{
      background-color:Red;
     }
     .onTime{
      background-color:#00aab8;

     }
     
      </style>


  

    <td  @if($hours != 0 || $min != 0) ? class="late" : class="onTime" @endif style="text-align:center;line-height: 14px;">{{$hours}} ساعة و{{$min}} دقائق </td>

    </tr> 
    @endforeach    


  


  </tbody>
</table><style>#tab {
  border: 1px solid black;
  direction: rtl;
  width:300px;
  margin-left:420px;
  border-color:#999999;
}
.head{
  color: #3F2986;
  font-weight:bolder;
}
#short{
border-collapse: collapse;
direction: rtl;
width:115%;
height:100%;
}
td{
  text-align:center;
}
#short th {
  height: 40px;
  font-size: large;
  background-color:#3F2986;
  color:white;
}
.s{
  height:30px;
  background-color:#C0C0C0
  
}
.t{
  height:30px;
  background-color:#00aab8
  
}
.y{
  height:30px;
  background-color:#C0C0C0
}
table, td, th {
  border: 1px solid #ddd;
}
</style>

<br></br>
<br></br>
<br></br>


<div class="short">

<table  name="short" id="short" border="1" style="direction: rtl;">
<tr>
<th colspan="10"> ملخص الحضور والغياب خلال الشهر</th>

</tr>
  <tr>
    <th colspan="5" >الاجازات</th>
     <th colspan="1">الغياب</th>
     <th colspan="2">الإستئذان</th>
    <th colspan="2">التأخير</th>
  </tr>
  <tr>
    <td class="s">العدد</td>
    <td class="s">إعتيادي</td>
    <td class="s">إضطراري</td>
    <td class="s">مرضي</td>
    <td class="s">وفاة</td>
    <td class="s">بدون عذر</td>
    <td class="t">العدد </td>

    <td class="t">فترة الإستئذان</td>
    <td class="y">العدد </td>
    <td class="y">فترة التأخير</td>
  </tr>

   <tr>
<?php
$a=$userinfo->calcVaccationPDF($month,$userinfo->id);//e3tyadi
$ab=$userinfo->etraryCalc($userinfo->id,true); //eterary
$b=$userinfo->calcSickLeavePDF($month,$userinfo->id);//mara6'y
$c=$userinfo->calcDeathLeavePDF($month,$userinfo->id);//death
$total_vacc=$a+$ab+$b+$c;
?>
    <td>{{$total_vacc}}</td>
    <td>{{$userinfo->calcVaccationPDF($month,$userinfo->id)}}</td>
    <td>{{$userinfo->etraryCalc($userinfo->id,true)}}</td>
    <td>{{$userinfo->calcSickLeavePDF($month,$userinfo->id)}}</td>
    <td>{{$userinfo->calcDeathLeavePDF($month,$userinfo->id)}}</td>
    <td>{{$userinfo->absentCalculator($userinfo->id,$month)}}</td>
    <td>{{$userinfo->excusesHours($userinfo->id,$month,1)}}</td>
    <td>{{$userinfo->excusesHours($userinfo->id,$month,0)}}</td>
    <td>{{$userinfo->calc($userinfo->id,$month,false,1)}}</td>
    <td>{{$userinfo->calc($userinfo->id,$month,false,0)}}</td>
  </tr>

</table>
</div>
<style> 
 * { font-family: Arial,DejaVu Sans, sans-serif; }
</style>

    
<!-- 
<h4>مجموع دقائق الإستئذان: {{$userinfo->calc($userinfo->id,$month)}}</h4>

<h4>مجموع دقائق التأخير:{{$userinfo->calc()}}</h4> -->

<style> 
 * { font-family: Arial,DejaVu Sans, sans-serif; }
</style>