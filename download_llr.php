<?php
require 'config.php';

// Get the application ID from the URL parameter
$id = $_GET['applicant_id'];

// Fetch data from the llr_applications table
$sql = "SELECT * FROM llr_applications WHERE applicant_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the application exists
if (!$row) {
    echo "Application not found.";
    exit;
}
// Generate a 16-digit license number
$license_number = substr(str_shuffle("0123456789"), 0, 16);

?>

<html>

<head>
    <title>Print LLR</title>
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

        .license-number {
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
    </style>
</head>

<body>
    <br>
    <table border="1" cellpadding="10" cellspacing="10" align="center">
        <tr>
            <td colspan="4" class="center bold"><b>RTO of Maharashtra<br><br> Learner's License</b></td>
        </tr>
        <tr>
            <td>License Number</td>
            <td colspan="2"><?php echo $license_number ?></td>
            <td width="100px" rowspan="3"> <img src="OIP.jpeg" height="100px" width="100px"> </td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php echo $row['applicant_name'] ?></td>
        </tr>
        <tr>
            <td>Father's Name</td>
            <td><?php echo $row['father_name'] ?></td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td colspan="2"><?php echo $row['date_of_birth'] ?> </td>
        </tr>
        <tr>
            <td>Address</td>
            <td colspan="2"><?php echo $row['address'] ?> </td>
        </tr>
        <tr>
            <td>Aadhar Card</td>
            <td colspan="2"><?php echo $row['aadhar_card'] ?> </td>
        </tr>

        <tr>
            <td>LLR Issue Date</td>
            <td colspan="2"><?php echo $row['issue_learning_date'] ?></td>
        </tr>
        <tr>
            <td>LLR Expiry Date</td>
            <td colspan="2"><?php echo $row['expiry_date'] ?></td>
        </tr>
    </table>
    <br><br>
    <button class="print-button" onclick="window.print()">Print</button>
</body>

</html>