<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-area'></i>
            <span class="logo_name">AMS</span>
        </div>
        <ul class="nav-links">
            <?php if (isset($_SESSION['name'])) { ?>
                <li>
                    <a href="index.php" class="active">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="manage_subject.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">Manage Subject</span>
                    </a>
                </li>

                <?php if($_SESSION['role'] == 0){ ?>
                <li>
                    <a href="takeattendace.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">Take Attendance</span>
                    </a>
                </li>
                <?php }?>
                <?php if($_SESSION['role'] == 1){ ?>
                <li>
                    <a href="teacher.php">
                        <i class='bx bx-user-circle'></i>
                        <span class="links_name">Manage Teacher</span>
                    </a>
                </li>
                <?php }?>
                <li>
                    <a href="student.php">
                        <i class='bx bx-user-check'></i>
                        <span class="links_name">Manage Student</span>
                    </a>
                </li>

                <li>
                    <a href="viewclassattendance.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">View Class Attendance</span>
                    </a>
                </li>

                <li>
                    <a href="viewstudentattendance.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">View Student Attendance</span>
                    </a>
                </li><li>
                    <a href="report.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">Download Attendance</span>
                    </a>
                </li>
                <li class="log_out">
                    <a href="logout.php">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Log out</span>
                    </a>
                </li>
            <?php } else{?>

            <!-- For Student/Parents -->
            <li>
                <a href="viewclassattendance.php">
                    <i class='bx bx-chalkboard'></i>

                    <span class="links_name">View Class Attendance</span>
                </a>
            </li>

            <li>
                <a href="viewstudentattendance.php">
                    <i class='bx bx-chalkboard'></i>

                    <span class="links_name">View Student Attendance</span>
                </a>
            </li>
            <li>
                    <a href="report.php">
                        <i class='bx bx-chalkboard'></i>

                        <span class="links_name">Download Attendance</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <section class="home-section ">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search for...">
                <i class='bx bx-search'></i>
            </div>
            <!-- profile-details -->
            <?php if (isset($_SESSION['name'])) { ?>
                <div class="profile-details">
                    <img src="img/undraw_profile.svg" alt="">
                    <span class="admin_name">Hello <?php echo $_SESSION['name'] ?></span>
                    <i class='bx bx-chevron-down'></i>
                </div>
            <?php } else { ?>
                <form action="login.php">
                    <button class="btn btn-primary">Login</button>
                </form>
            <?php }
            ?>
        </nav>
    </section>
    <div class="container w-70 mr-3 ">
        <?php include "graph.php"; ?>
    </div>
</body>

<script>
    let sidebar = document.querySelector('.sidebar');
    let sidebarBtn = document.querySelector('.sidebarBtn');
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            sidebarBtn.classList.replace('bx-menu', 'bx-menu-alt-right');
        } else
            sidebarBtn.classList.replace('bx-menu-alt-right', 'bx-menu');
    }
</script>

</html>