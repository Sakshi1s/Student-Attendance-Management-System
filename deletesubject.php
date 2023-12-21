<?php
    include "config/conn.php";

                $id = $_GET['suid'];

                $sql_i = "DELETE FROM  tblsubject WHERE SID={$id}";
                $delete = mysqli_query($conn, $sql_i) or die("Delete failed");
                if ($delete) {
                    echo "<script>alert('hi')</script>";
                    header("Location: http://localhost/Mini-Project/manage_subject.php");
                    mysqli_close($conn);
                }

?>