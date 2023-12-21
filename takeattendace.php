<?php
include "config/conn.php";
include "config/session.php";
?>


<?php

$alert = "";
if (isset($_POST['save'])) {
    if (isset($_POST['update'])) {
        foreach ($_POST['update'] as $updateid) {

            $name = $_POST['name_' . $updateid];
            $prn = $_POST['prn_' . $updateid];
            $subject = $_POST['subject_' . $updateid];

            $sem = $_POST['sem_' . $updateid];
            $branch = $_POST['branch_' . $updateid];
            $takenby = $_POST['takenby_' . $updateid];
            $date = $_POST['date_' . $updateid];



            $insert = "INSERT INTO tblattendance(name,prn,sem,branch,subject,takenby,date)
						VALUES('" . $name . "','" . $prn . "','" . $sem . "','" . $branch . "','" . $subject . "','" . $takenby . "','" . $date . "')";
            mysqli_query($conn, $insert) or die('Result Failed');
        }
        $alert = '<div class="alert alert-success" role="alert">Attendance Taken successfully </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Take Attendance</title>
</head>

<style>
  header {
    background-color: #0A2558;
    height: 50px;
    text-align: center;
    font-size: 30px;
    font-family: 'Poppins', sans-serif;
    color: rgb(255, 255, 255);
  }
</style>

<body>
  <header class="mb-1">
    <h2>Take Attendance [ Today's Date : <?php echo  date("m-d-Y"); ?> ]</h2>
  </header>

  <div class="row">

    <div class="col-lg-12">
      <!-- Form Basic -->
      <?php
            $fetch_sql =
                "SELECT * FROM tblteacher 
                    INNER JOIN tblclass 
                    ON tblteacher.sem = tblclass.ID
                    INNER JOIN tblbranch
                    ON tblteacher.branch = tblbranch.ID
                    INNER JOIN tblsubject
                    ON tblteacher.subject = tblsubject.SID  
                    WHERE tblteacher.tid = {$_SESSION['id']} " or die("Fetching failed");
            $res_fetch = mysqli_query($conn, $fetch_sql) or die("result failed");
            if (mysqli_num_rows($res_fetch) > 0) {
                while ($row = mysqli_fetch_assoc($res_fetch)) {
                    $tsem = $row['nsem'];
                    $branch = $row['branch'];
                    $tsubject = $row['name'];
                }
            }
            ?>

      <!-- Input Group -->
      <form>
        <input type="button" class="btn btn-warning m-3" value="Go back!" onclick="goBack()">
      </form>
      <form method="post" action='<?php echo $_SERVER['PHP_SELF'] ?>'><?php echo $alert; ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $tsem ?> Semester Section</h6>
                
              </div>
              <div class="table-responsive p-3">

                <table class="table align-items-center table-flush table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th><input type='checkbox' id='checkAll'> Check</th>
                      <th>PRN</th>
                      <th>Name</th>
                      <th>Subject</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                    $query =
                        "SELECT * FROM tblstudent
                        WHERE sem = {$_SESSION['sem']}
                     order by prn";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['STID'];
                        $name = $row['sname'];
                        $prn = $row['prn'];
                        $sem = $row['sem'];
                        $branch = $row['branch'];
                        $subject = $tsubject;
                        $takenby = $_SESSION['name'];
                         $date =  date("Y-m-d");
                        
                    ?>
                        <tr >
                            <td><input type='checkbox' name='update[]' value='<?= $id ?>' ></td>

                            <td><input type='text' name='prn_<?= $id ?>' value='<?= $prn ?>' style="border: none;" readonly></td>
                            <td><input type='text' name='name_<?= $id ?>' value='<?= $name ?>' style="border: none;" readonly></td>
                            <td><input type='text' name='subject_<?= $id ?>' value='<?= $subject ?>' style="border: none;" readonly></td>

                            <td><input hidden type='text' name='takenby_<?= $id ?>' value='<?= $takenby ?>'></td>
                            <td><input hidden type='text' name='sem_<?= $id ?>' value='<?= $sem ?>'></td>
                            <td><input hidden type='text' name='branch_<?= $id ?>' value='<?= $branch ?>'></td>
                            <td><input hidden type='date' name='date_<?= $id ?>' value='<?=  $date ?>'></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

                
                  </tbody>
                </table>
                <br>
                <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
      </form>
      
    </div>
  </div>



  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Check/Uncheck ALl
        $('#checkAll').change(function() {
            if ($(this).is(':checked')) {
                $('input[name="update[]"]').prop('checked', true);
            } else { 
                $('input[name="update[]"]').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
        // Checkbox click
        $('input[name="update[]"]').click(function() {
            var total_checkboxes = $('input[name="update[]"]').length;
            var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

            if (total_checkboxes_checked == total_checkboxes) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    });

    function goBack() {
        window.location.href = "index.php"
      }

</script>
</html>