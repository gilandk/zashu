<?php
include('include/header.php');
?>

<div class="col-md-9 bg-white padding-2">
  <h2><i>Applicant Profile</i></h2>
  <form action="update-profile.php" method="post" enctype="multipart/form-data">
    <?php
    //Sql to get logged in user details.
    $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
    $result = $conn->query($sql);

    //If user exists then show his details.
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <div class="row">
          <div class="col-md-12 latest-job">

            <div class="form-group">
              <label>Change Profile Picture</label>
              <?php
              if ($row['profile'] > 0) {
                $image = $row['profile'];
              } else {
                $image = "2x2.jpg";
              }
              ?>

              <div align="center" style="width:144px;height:144px;padding:2px;">
                <img src="../uploads/profile/<?php echo $image; ?>" class="img-thumbnail" style="max-height:100%;max-width:100%;">
              </div>

              <br />
              <input type="file" name="image" class="btn btn-default">
            </div>

            <div class="box box-solid box-primary">
              <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
                <h3 class="box-title">Personal Info</h3>
              </div>
              <div class="box-body">

                <div class="form-group">
                  <label for="sno">DYCI Student Number</label>
                  <input type="text" class="form-control input-lg" id="sno" name="sno" placeholder="Student Number" value="<?php echo $row['sno']; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="fname">Full Name</label>
                  <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="Full Name" value="<?php echo $row['fname']; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control input-lg" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="contactno">Contact Number</label>
                  <input class="form-control input-lg" type="text" id="contactno" name="contactno" minlength="11" maxlength="11" onkeypress="return validatePhone(event);" placeholder="Phone Number" value="<?php echo $row['contactno']; ?>">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea id="address" name="address" class="form-control input-lg" rows="5" placeholder="Address"><?php echo $row['address']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="city">State/Region/Province</label>
                  <input type="text" class="form-control input-lg" id="state" name="state" value="<?php echo $row['state']; ?>" placeholder="State/Region/Province">
                </div>

                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control input-lg" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="city">
                </div>

                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input class="form-control input-lg" type="date" id="dob" min="1960-01-01" name="dob" value="<?php echo $row['dob']; ?>">
                </div>

                <div class="form-group">
                  <label for="age">Age</label>
                  <input class="form-control input-lg" type="text" id="age" name="age" placeholder="Age" value="<?php echo $row['age']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="qualification">Gender</label>
                  <select class="form-control input-lg" type="text" id="gender" name="gender" required>
                    <option value="">---Select Gender---</option>
                    <option <?php if ($row['gender'] == "Male") echo "selected" ?>>Male</option>
                    <option <?php if ($row['gender'] == "Female") echo "selected" ?>>Female</option>
                    <option <?php if ($row['gender'] == "Other") echo "selected" ?>>Other</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="city">Civil Status</label>
                  <input type="text" class="form-control input-lg" id="civilstatus" name="civilstatus" value="<?php echo $row['civilstatus']; ?>" placeholder="Civil Status">
                </div>

                <div class="form-group">
                  <label for="city">Nationality</label>
                  <input type="text" class="form-control input-lg" id="nationality" name="nationality" value="<?php echo $row['nationality']; ?>" placeholder="Nationality">
                </div>

              </div>
            </div>

            <div class="box box-solid box-primary">
              <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
                <h3 class="box-title">Educational Background</h3>
              </div>
              <div class="box-body">

                <div class="form-group">
                  <label for="fos">Field of Study</label>
                  <input type="text" class="form-control input-lg" id="fos" name="fos" placeholder="Field of Study" value="<?php echo $row['fos']; ?>">
                </div>
                <div class="form-group">
                  <label for="course">Course</label>
                  <select class="form-control input-lg" type="text" id="course" name="course" required>
                    <option value="">Select Course...</option>
                    <!-- CCS -->
                    <option <?php if ($row['course'] == 'BSIT') echo "selected" ?>>BSIT</option>
                    <option <?php if ($row['course'] == 'BSCS') echo "selected" ?>>BSCS</option>
                    <option <?php if ($row['course'] == 'BSCOE') echo "selected" ?>>BSCOE</option>
                    <option <?php if ($row['course'] == 'ACT') echo "selected" ?>>ACT</option>
                    <!-- COA -->
                    <option <?php if ($row['course'] == 'BSA') echo "selected" ?>>BSA</option>
                    <option <?php if ($row['course'] == 'BSIS') echo "selected" ?>>BSIS</option>
                    <option <?php if ($row['course'] == 'BSAT') echo "selected" ?>>BSAT</option>
                    <!-- CBA -->
                    <option <?php if ($row['course'] == 'BSBA - HRDM') echo "selected" ?>>BSBA - HRDM</option>
                    <option <?php if ($row['course'] == 'BSBA - FM') echo "selected" ?>>BSBA - FM</option>
                    <option <?php if ($row['course'] == 'BSBA - OM') echo "selected" ?>>BSBA - OM</option>
                    <option <?php if ($row['course'] == 'BSBA - MM') echo "selected" ?>>BSBA - MM</option>
                    <!-- CHS -->
                    <option <?php if ($row['course'] == 'BSN') echo "selected" ?>>BSN</option>
                    <option <?php if ($row['course'] == 'BSM') echo "selected" ?>>BSM</option>
                    <!-- COED -->
                    <option <?php if ($row['course'] == 'BEED') echo "selected" ?>>BEED</option>
                    <option <?php if ($row['course'] == 'BSED BIO') echo "selected" ?>>BSED BIO</option>
                    <option <?php if ($row['course'] == 'BSED MATH') echo "selected" ?>>BSED MATH</option>
                    <option <?php if ($row['course'] == 'BSED ENGLISH') echo "selected" ?>>BSED ENGLISH</option>
                    <option <?php if ($row['course'] == 'BSED FIL') echo "selected" ?>>BSED FIL</option>
                    <!-- CAS -->
                    <option <?php if ($row['course'] == 'AB Psy') echo "selected" ?>>AB Psy</option>
                    <option <?php if ($row['course'] == 'AB Pol Scie') echo "selected" ?>>AB Pol Scie</option>
                    <!-- CME -->
                    <option <?php if ($row['course'] == 'BSME') echo "selected" ?>>BSME</option>
                    <!-- CHMT -->
                    <option <?php if ($row['course'] == 'BSHRM') echo "selected" ?>>BSHRM</option>
                    <option <?php if ($row['course'] == 'BST') echo "selected" ?>>BST</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="yearAt">Year Attended</label>
                  <input class="form-control input-lg" type="month" id="yearAt" name="yearAt" placeholder="Year Attended" value="<?php echo $row['yearAt']; ?>">
                </div>

                <div class="form-group">
                  <label for="passingyear">Year Graduated</label>
                  <input class="form-control input-lg" type="month" id="passingyear" name="passingyear" placeholder="Year Graduated" value="<?php echo $row['passingyear']; ?>">
                </div>


                <div class="form-group">
                  <label for="qualification">Qualification</label>
                  <select class="form-control input-lg" type="text" id="qualification" name="qualification" required>
                    <option value="">---Select Qualification---</option>
                    <option <?php if ($row['qualification'] == "Junior High School") echo "selected" ?>>Junior High School</option>
                    <option <?php if ($row['qualification'] == "Senior High School") echo "selected" ?>>Senior High School</option>
                    <option <?php if ($row['qualification'] == "Undergraduate") echo "selected" ?>>Undergraduate</option>
                    <option <?php if ($row['qualification'] == "Vocational Diploma/Short Course Certificate") echo "selected" ?>>Vocational Diploma/Short Course Certificate</option>
                    <option <?php if ($row['qualification'] == "Bachelor's Degree") echo "selected" ?>>Bachelor's Degree</option>
                    <option <?php if ($row['qualification'] == "Master's Degree") echo "selected" ?>>Master's Degree</option>
                    <option <?php if ($row['qualification'] == "Doctorate Degree") echo "selected" ?>>Doctorate Degree</option>
                    <option <?php if ($row['qualification'] == "Professional License(Passed Board/Bar/Professional License Exam)") echo "selected" ?>>Professional License(Passed Board/Bar/Professional License Exam)</option>
                  </select>
                </div>

              </div>
            </div>

            <div class="box box-solid box-primary">
              <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
                <h3 class="box-title">Employment History</h3>
              </div>

              <div class="box-body">

                <div class="form-group">
                  <label for="city">Company Name</label>
                  <input type="text" class="form-control input-lg" id="company_name" name="company_name" value="<?php echo $row['company_name']; ?>" placeholder="Company Name">
                </div>
                <div class="form-group">
                  <label for="city">Company Industry</label>
                  <input type="text" class="form-control input-lg" id="industry" name="industry" value="<?php echo $row['industry']; ?>" placeholder="Industry">
                </div>
                <div class="form-group">
                  <label for="city">Company Address</label>
                  <input type="text" class="form-control input-lg" id="company_add" name="company_add" value="<?php echo $row['company_add']; ?>" placeholder="Company Address">
                </div>
                <div class="form-group">
                  <label for="city">Position</label>
                  <input type="text" class="form-control input-lg" id="position" name="position" value="<?php echo $row['position']; ?>" placeholder="Position">
                </div>
                <div class="form-group">
                  <label for="emp_type">Employment Type</label>
                  <select class="form-control input-lg" id="emp_type" name="emp_type">
                    <option style="color:gray" value="" disabled selected>---------------</option>
                    <option <?php if ($row['emp_type'] == "Full-Time") echo "selected" ?>>Full-Time</option>
                    <option <?php if ($row['emp_type'] == "Project-Based") echo "selected" ?>>Project-Based</option>
                    <option <?php if ($row['emp_type'] == "Contractual") echo "selected" ?>>Contractual</option>
                    <option <?php if ($row['emp_type'] == "Part-Time") echo "selected" ?>>Part-Time</option>
                    <option <?php if ($row['emp_type'] == "Internship") echo "selected" ?>>Internship</option>
                  </select>
                  <div class="form-group">
                    <label for="yearAt">Date Joined</label>
                    <input class="form-control input-lg" type="month" id="datejoined" name="datejoined" placeholder="Date Joined" value="<?php echo $row['datejoined']; ?>">
                  </div>

                  <div class="form-group">
                    <label for="yearAt">Date Left</label>
                    <input class="form-control input-lg" type="month" id="dateleft" name="dateleft" placeholder="Date Left" value="<?php echo $row['dateleft']; ?>">
                  </div>

                  <div class="form-group">
                    <label>Reason for Leaving</label>
                    <textarea class="form-control input-lg" rows="2" name="reason"><?php echo $row['reason']; ?></textarea>
                  </div>

                </div>
                </div>
              </div>

              <div class="box box-solid box-primary">
                <div class="box-header with-border">
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                  <h3 class="box-title">Additional Info</h3>
                </div>
                <div class="box-body">

                  <div class="form-group">
                    <label>Skills</label>
                    <textarea class="form-control input-lg" rows="4" name="skills"><?php echo $row['skills']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea class="form-control input-lg" rows="4" name="aboutme"><?php echo $row['aboutme']; ?></textarea>
                  </div>

                </div>
              </div>

              <div class="form-group">
                <label>Upload/Change Resume</label>
                <input type="file" name="resume" class="btn btn-default">
                <br />
                <?php
                if ($row['resume'] != "") {
                  echo '<a href="../uploads/resume/' . $row['resume'] . '" download="' . $row['fname'] . ' Resume"><i class="fa fa-file-pdf-o fa-2x"></i><em> ' . $row['fname'] . ' Resume </em></a>';
                }
                ?>
              </div>

              <div class="form-group">
                <button type="submit"class="btn btn-primary">Update Profile</button>
              </div>

            </div>

        <?php
      }
    }
        ?>
  </form>
  <?php if (isset($_SESSION['uploadError'])) { ?>
    <div class="row">
      <div class="col-md-12 text-center">
        <?php echo $_SESSION['uploadError']; ?>
      </div>
    </div>
  <?php } ?>
</div>
</div>
</div>
</section>



</div>
<!-- /.content-wrapper -->

<?php
include('include/footer.php');
?>