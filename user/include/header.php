<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

  <script src="../js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: '#description',
      height: 150
    });
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo logo-bg">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>J</b>P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Job</b> Portal</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown messages-menu">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope-o"></i>
                <?php //notif count
                $sql = "SELECT * FROM `mailbox` WHERE (id_fromuser='$_SESSION[id_user]' OR id_touser='$_SESSION[id_user]') AND AmsgRead='0'";
                $result = $conn->query($sql);
                $notif = $result->num_rows;
                ?>
                <?php
                if ($notif == '0') {
                  echo '';
                } else {
                  echo '<span class="label label-pill label-danger count" style="border-radius:20px;"> ' . $notif . '</span>';
                }
                ?>
              </a>

              <ul class="dropdown-menu">
                <li class="header">You have <?php echo $notif; ?> messages</li>
                <li>
                  <ul class="menu">
                    <?php // mailbox notif dropdown
                    $sql = "SELECT * FROM mailbox WHERE (id_fromuser='$_SESSION[id_user]' OR id_touser='$_SESSION[id_user]') AND AmsgRead='0' ORDER BY createdAt DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($rows = $result->fetch_array()) {
                        if ($rows['fromuser'] == "company") {
                          $sql1 = "SELECT * FROM company WHERE id_company='$rows[id_fromuser]'";
                          $result1 = $conn->query($sql1);
                          if ($result1->num_rows >  0) {
                            $rowsCompany = $result1->fetch_assoc();
                          }
                          $sql2 = "SELECT * FROM users WHERE id_user='$rows[id_touser]'";
                          $result2 = $conn->query($sql2);
                          if ($result2->num_rows >  0) {
                            $rowsUser = $result2->fetch_assoc();
                          }
                        } else {
                          $sql1 = "SELECT * FROM company WHERE id_company='$rows[id_touser]'";
                          $result1 = $conn->query($sql1);
                          if ($result1->num_rows >  0) {
                            $rowsCompany = $result1->fetch_assoc();
                          }
                          $sql2 = "SELECT * FROM users WHERE id_user='$rows[id_fromuser]'";
                          $result2 = $conn->query($sql2);
                          if ($result2->num_rows >  0) {
                            $rowsUser = $result2->fetch_assoc();
                          }
                        }
                    ?>

                        <li>
                          <a style="font-weight:bold;" href="read-mail.php?id_mail=<?php echo $rows['id_mailbox']; ?>">
                            <?php
                            if ($rows['fromuser'] != "company") {
                              $rows['id_fromuser'];
                              $cname = $rowsCompany['companyname'];
                              $logo = $rowsCompany['logo'];
                            } else {
                              $rows['id_touser'];
                              $cname = $rowsCompany['companyname'];
                              $logo = $rowsCompany['logo'];
                            }

                            if ($rowsCompany['logo'] > 0) {
                              $image = $rowsCompany['logo'];
                            } else {
                              $image = "2x2.jpg";
                            }
                            ?>
                            <div class="pull-left">
                              <img src="../uploads/logo/<?php echo $logo; ?>" style="max-height:50px;max-width:50px;" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                              <?php echo $cname; ?>
                              <small><i class="fa fa-clock-o"></i> <?php echo date("d-M- h:i a", strtotime($rows['createdAt'])); ?></small>
                            </h4>
                            <p><?php echo $rows['subject']; ?></p>
                          </a>
                        </li>
                    <?php //end mailbox notif
                      }
                    } else {
                      echo '<li class="header"><a href="mailbox.php">No New Message</a></li>';
                    }
                    ?>
                  </ul>

                <li class="footer"><a href="mailbox.php">See All Messages</a></li>
              </ul>
            </li>
            <li>
              <a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a>
            </li>

            <li class="dropdown user user-menu">
              <?php
              $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {

                if ($row['profile'] > 0) {
                  $image = $row['profile'];
                } else {
                  $image = "2x2.jpg";
                }
              ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../uploads/profile/<?php echo $image; ?>" style="max-height:100px;max-width:100px;" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $row['fname']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../uploads/profile/<?php echo $image; ?>" style="max-height:100px;max-width:100px;" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $row['fname']; ?>
                      <small>Member since <?php echo date("M.Y", strtotime($row['joindate'])); ?></small>
                      <small><strong><?php echo $row['course']; ?></strong></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="edit-profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              <?php
              }
              ?>
            </li>

          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper" style="margin-left: 0px;">

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome Applicant</b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                    <li class="active"><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                    <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox &nbsp;
                        <?php
                        if ($notif == '0') {
                          echo '';
                        } else {
                          echo '<span class="label label-pill label-danger count" style="border-radius:20px;"> ' . $notif . '</span>';
                        }
                        ?>
                      </a>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>