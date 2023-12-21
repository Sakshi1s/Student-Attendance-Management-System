<?php
include "config/conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <title>Dashboard</title>

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

<header>
        <h2> Class Attendance</h2>
</header>

        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Search Class Attendance</h6>
                        
                    </div>
                    <div class="card-body">
                        <!-- <form method="post">
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Date<span class="text-danger ml-2">*</span></label>
                                    <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Arm Name">
                                </div>
                               <?php
                                // $dateTaken =  $_POST['dateTaken'];
                                 ?>
                            </div>
                            <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                        </form> -->
                        <form>
 <input type="button" class="btn btn-warning" style="color:black;" value="Go back!" onclick="getBack()">
 </form>
                    </div>
                </div>

                <!-- Input Group -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>PRN Number</th>
                                            <th>SEM</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                <?php
                                   
                                        // $sprn = $_POST['studentlist'];
                                        // if ($sprn == "none") {
                                        //     $sql2 = "SELECT * FROM tblattendance";
                                        // } else {
                                        //     $sql2 = "SELECT * FROM tblattendance WHERE name='{$sprn}'";
                                        // }
                                        $sql2 = "SELECT * FROM tblattendance";
                                        $result2 = mysqli_query($conn, $sql2) or die("Query Failed: student attendance display failed");
                                        if (mysqli_num_rows($result2) > 0) {
                                    ?>
                                            <tbody>
                                                <?php while ($row1 = mysqli_fetch_assoc($result2)) { ?>
                                                    <tr>
                                             <td><?php echo $row1['name']?></td>
                                             <td><?php echo $row1['prn'] ?></td>
                                             <td><?php echo $row1['sem'] ?></td>
                                             <td><?php echo $row1['subject'] ?></td>
                                             <td><?php 
                                             if($row1['status'] == 0){
                                                echo "Present";
                                             }
                                             ?></td>
                                             <td><?php echo $row1['date'] ?></td>
                                         </tr>
                                              
                                        <?php } ?>

                                            </tbody>
                                        <?php }
                                    
?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!---Container Fluid-->

</body>
<script>
    function goBack() {
        window.location.href = "index.php"
      }
</script>

</html>