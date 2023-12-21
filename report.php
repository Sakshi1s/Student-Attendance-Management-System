<?php
include "config/conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Attendance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
<style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
        
        h1 {
            text-align: center;
            color: hsl(253, 83%, 23%);
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
        
        td {
            background-color: #ffffff;
            border: 1px solid black;
        }
        
        th {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        
        td {
            font-weight: lighter;
            padding: 10px;
            text-align: center;
        }
        
        .btn {
            background-color: hsl(219, 79%, 15%);
            border: none;
            color: white;
            padding: 12px 30px;
            cursor: pointer;
            font-size: 20px;
        }
        /* Darker background on mouse-over */
        
        .btn:hover {
            background-color: rgb(31, 74, 203);
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>





<body>
    <section>
        <h1>Student Attendance</h1>
        <div align='center'>
            <button class="btn" id="download"><i class="fa fa-download"></i> Download Report</button>
        </div><br>
        <!-- TABLE CONSTRUCTION -->
        <table id="report">
            <tr>
                <th>Student Name</th>
                <th>PRN No</th>
                <th>TOC</th>
                <th>HCI</th>
                <th>SE</th>
                <th>DBS</th>
                <th>BC</th>
                <th>EET</th>
                <th>Aptitude</th>
                <th>Total Attendance</th>
            </tr>
            <tr>
                <!-- FETCHING DATA FROM EACH
            ROW OF EVERY COLUMN -->
                <td>
                    Gunjan Waghule
                </td>
                <td>
                    2046491245018
                </td>
                <td>
                    24
                </td>
                <td>
                    24
                </td>
                <td>
                    15
                </td>
                <td>
                    23
                </td>
                <td>
                    21
                </td>
                <td>
                    21
                </td>
                <td>
                    21
                </td>
                <td>
                    149
                </td>
            </tr>
            <tr>
                <td>
                    Mahesh Rohane
                </td>
                <td>
                    2046491245021
                </td>
                <td>
                    24
                </td>
                <td>
                    24
                </td>
                <td>
                    15
                </td>
                <td>
                    23
                </td>
                <td>
                    21
                </td>
                <td>
                    21
                </td>
                <td>
                    25
                </td>
                <td>
                    148
                </td>
            </tr>
            <tr>
                <td>
                    Sakshi Sahu
                </td>
                <td>
                    2046491245039
                </td>
                <td>
                    24
                </td>
                <td>
                    24
                </td>
                <td>
                    15
                </td>
                <td>
                    23
                </td>
                <td>
                    29
                </td>
                <td>
                    21
                </td>
                <td>
                    30
                </td>
                <td>
                    166
                </td>
            </tr>
        </table>
    </section>
</body>








<script>
    const button = document.getElementById('download');
    let opt = {
        margin: 1,
        filename: 'Attendance.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'a2',
            orientation: 'portrait'
        }
    };

    function generatePDF() {
        // Choose the element that your content will be rendered to.
        const element = document.getElementById('report');
        // Choose the element and save the PDF for your user.
        html2pdf().set(opt).from(element).save();
    }

    button.addEventListener('click', generatePDF);
</script>

</html>