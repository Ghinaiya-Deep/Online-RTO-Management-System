<?php
require 'config.php';

// Get the application ID from the URL parameter
$id = $_GET['registration_number'];

// Fetch data from the llr_applications table
$sql = "SELECT * FROM vehicle_registration WHERE registration_number = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the application exists
if (!$row) {
    echo "Application not found.";
    exit;
}
// Generate a 16-digit license number
$random_number = substr(str_shuffle("0123456789"), 0, 4);
$series = chr(rand(65, 90)) . chr(rand(65, 90)); // generates a random two-character series
$registration_number = "MH-" . rand(10, 99) . " " . $series . "-" . $random_number;

?>

<html>

<head>
    <title>Print Vehicle Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            height: 80%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .registration-number {
            font-size: 18px;
            font-weight: bold;
        }

        .print-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .print-button:hover {
            background-color: #3e8e41;
        }

        .vehicle-registration-number {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <br>
    <table border="1" cellpadding="10" cellspacing="10" align="center">
        <tr>
            <td colspan="4" class="center bold"><b>RTO of Maharashtra<br><br> Vehicle Registration</b></td>
        </tr>
        <tr>
            <td>Vehicle Registration Number</td>
            <td colspan="2"><?php echo $registration_number ?></td>
            <td width="100px" rowspan="3"> <img src="OIP.jpeg" height="100px" width="100px"> </td>
        </tr>
        <tr>
            <td>Owner Name</td>
            <td><?php echo $row['owner_name'] ?></td>
        </tr>
        <tr>
            <td>Owner Email</td>
            <td colspan="2"><?php echo $row['owner_email'] ?> </td>
        </tr>
        <tr>
            <td>Vehicle Year</td>
            <td colspan="2"><?php echo $row['vehicle_year'] ?></td>
        </tr>
        <tr>
            <td>Engine Number</td>
            <td colspan="2"><?php echo $row['engine_number'] ?> </td>
        </tr>
        <tr>
            <td>Chassis Number</td>
            <td colspan="2"><?php echo $row['chassis_number'] ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td colspan="2"><?php echo $row['address'] ?> </td>
        </tr>


    </table>
    <br><br>
    <button class="print-button" onclick="window.print()">Print</button>
</body>

</html>