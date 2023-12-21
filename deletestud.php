<?php
    include "config/conn.php";

                $id = $_GET['stid'];

                $sql_i = "DELETE FROM  tblstudent WHERE ID={$id}";
                $delete = mysqli_query($conn, $sql_i) or die("Delete failed");
                if ($delete) {
                    echo "<script>alert('hi')</script>";
                    header("Location: http://localhost/Mini-Project/student.php");
                    mysqli_close($conn);
                }

?>