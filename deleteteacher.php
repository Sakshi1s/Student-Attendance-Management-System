<?php
    include "config/conn.php";

                $id = $_GET['tid'];

                $sql_i = "DELETE FROM  tblteacher WHERE tid={$id}";
                $delete = mysqli_query($conn, $sql_i) or die("Delete failed");
                if ($delete) {
                    
                    mysqli_close($conn);
                    header("Location: http://localhost/Mini-Project/teacher.php");
                }

?>