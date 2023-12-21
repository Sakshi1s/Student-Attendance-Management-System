<?php
include "config/conn.php";


$test = array();
$count = 0;
$sql = "SELECT * FROM tblcalattendance" or die("Failed");
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res)) {
    $test[$count]['label'] = $row['subject'];
    $test[$count]['y'] = $row['percentage'];
    $count++;
}


?>
<!DOCTYPE HTML>
<html>

<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: ""
                },
                axisY: {
                    suffix: "%",
                    scaleBreaks: {
                        autoCalculate: true
                    }
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0\"%\"",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <?php
    $res_stu = mysqli_query($conn, "SELECT sname FROM tblstudent") or die("Result Failed");
    if (mysqli_num_rows($res_stu) > 0) {
        while ($row = mysqli_fetch_assoc($res_stu)) {
    ?>
            <?php echo "{$row['sname']}"; ?>
            <?php $name = $row['sname']; ?>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <?php
        }
    }
    ?>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>