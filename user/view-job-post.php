<?php

include('include/header.php');

$sql = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$_GET[id]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  $sql1 = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
  $result1 = $conn->query($sql1);
  if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
  }
} else {
  header("Location: index.php");
  exit();
}
?>

<div class="col-md-12 bg-white padding-2">
  <div class="pull-left">
    <?php
    if ($row['logo'] > 0) {
      $image = $row['logo'];
    } else {
      $image = "2x2.jpg";
    }
    ?>
    <div align="center" style="width:150px;height:150px;">
      <img src="../uploads/logo/<?php echo $image; ?>" class="img-thumbnail img-circle">
    </div>
  </div>
  <div class="pull-left" style="margin-left:10px;">
    <h3><b><i><?php echo $row['companyname']; ?></b></i></h3>

    <h2><b><i><?php echo $row['jobtitle']; ?></i></b></h2>
    <h4><i>(<?php echo $row['jobtype']; ?>)</i></h4>
  </div>

  <div class="pull-right">
    <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a><br /><br />
    <a href="create-mail.php" class="btn btn-primary"><i class="fa fa-envelope"></i> Email</a>
  </div>
  <div class="clearfix"></div>
  <hr>

  <div class="row">

    <div class="col-md-6">
      <h4 style="font-size:16px;"><b>Job Description</b></h4>
      <?php echo stripcslashes($row['description']); ?><br />
      <br />
      <div class="pull-left">
        <p style="font-size:16px;"><i class="fa fa-users" aria-hidden="true"></i> <strong>Position available : </strong></p>
        <p style="font-size:16px;"><i class="fa fa-suitcase" aria-hidden="true"></i> <strong>With Experience atleast : </strong></p>
        <p style="font-size:16px;"> <i class="fa fa-usd" aria-hidden="true"></i> <strong>Salary : </strong></p>
        <p style="font-size:16px;"> <i class="fa fa-calendar-o" aria-hidden="true"></i> <strong>Apply Till : </strong></p>
      </div>

      <div class="pull-left" style="margin-left:30px;">
        <p style="font-size:16px;"> <?php echo $row['position']; ?></p>
      
        <p style="font-size:16px;"> <?php echo $row['experience']; ?> YEARS</p>
     
        <p style="font-size:16px;"> <i class="fa fa-rub" aria-hidden="true"></i> <?php echo number_format($row['minimumsalary']); ?> - </strong><i class="fa fa-rub" aria-hidden="true"></i> <?php echo number_format($row['maximumsalary']); ?></p>
  
        <p style="font-size:16px;"> <?php echo date("M-d-Y", strtotime($row['createdat'])); ?> - </strong><?php echo date("M-d-Y", strtotime($row['applyBy'])); ?>
        </p>
        <br/>
      </div>
    </div>
    <div class="col-md-6">
      <div>
        <h4 style="font-size:20px;"><b>COMPANY PROFILE</b></h4><br />
        <p style="font-size:16px;"><span class="margin-right-10"><i class="fa fa-globe"></i>&nbsp;&nbsp;&nbsp;<?php echo $row['website']; ?></span></p>
        <p style="font-size:16px;"><span class="margin-right-10"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;&nbsp;<?php echo $row['city']; ?>, <?php echo $row['state']; ?>, <?php echo $row['country']; ?></span></p>
        <p style="font-size:16px;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;<?php echo date("d-M-Y", strtotime($row['createdat'])); ?></p>
        <p style="font-size:16px;"> <i class="fa fa-telegram" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?php echo $row['contactno']; ?></p>
      </div>
      <br />
      <h4 style="font-size:16px;"><b>COMPANY SUMMARY</b></h4>
      <?php echo stripcslashes($row['aboutme']); ?><br />
      <br />
      <h4 style="font-size:16px;"><b>MISSION</b></h4>
      <?php echo stripcslashes($row['mission']); ?><br />
      <br />
      <h4 style="font-size:16px;"><b>VISION</b></h4>
      <?php echo stripcslashes($row['vision']); ?><br />
      <br />
    </div>
  </div>
  <br />
  <br />
</div>
</div>
<hr>
</div>
</div>
</section>

</div>
<!-- /.content-wrapper -->

<?php
include('include/footer.php');
?>