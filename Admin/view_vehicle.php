<?php
require 'config.php';

// Check if delete action is requested
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    deletevehicleApplication($conn, $_GET['id']);
    header("Location: view_vehicle.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Registration Applications</title>
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .icon {
            margin-right: 15px;
            color: black;
            font-size: 15px;
        }

        .icon:last-child {
            margin-right: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <h1>Vehicle Registration Applications</h1>
    <table>
        <tr>
            <th>Registration ID</th>
            <th>Owner Name </th>
            <th>Owner Email </th>
            <th>Vehicle Type</th>
            <th>Vehicle Model</th>
            <th>Vehicle Year</th>
            <th>Engine Number</th>
            <th>Chassis Number</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
            <th>Payment Method</th>
            <th>Upload Documents</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        require 'config.php';
        function getvehicleApplications($conn)
        {

            $sql = "SELECT * FROM vehicle_registration";
            $result = $conn->query($sql);
            return $result;
        }
        $result = getvehicleApplications($conn);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["registration_number"] . "</td>";
                echo "<td>" . $row["owner_name"] . "</td>";
                echo "<td>" . $row["owner_email"] . "</td>";
                echo "<td>" . $row["vehicle_type"] . "</td>";
                echo "<td>" . $row["vehicle_model"] . "</td>";
                echo "<td>" . $row["vehicle_year"] . "</td>";
                echo "<td>" . $row["engine_number"] . "</td>";
                echo "<td>" . $row["chassis_number"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                echo "<td>" . $row["pincode"] . "</td>";
                echo "<td>" . $row["payment_method"] . "</td>";
                echo "<td>" . $row["upload_documents"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>";
                if (isset($_GET['id']) && $_GET['id'] == $row["registration_number"]) {
                    if (isset($_GET['status']) && $_GET['status'] == 'approved') {
                        updatevehicleApplicationStatus($conn, $row["registration_number"]);
                    } elseif (isset($_GET['status']) && $_GET['status'] == 'rejected') {
                        updatevehicleApplicationStatus($conn, $row["registration_number"]);
                    }
                }
                echo "<a href='?id=" . $row["registration_number"] . "&status=approved' class='icon edit-icon'>Edit</a>";
                echo "<a href='?id=" . $row["registration_number"] . "&action=delete' class='icon delete-icon'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No data found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
function updatevehicleApplicationStatus($conn, $id)
{
    $sql = "SELECT status FROM vehicle_registration WHERE registration_number = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentStatus = $row["status"];

    if ($currentStatus == 'approved') {
        $newStatus = 'pending';
    } else {
        $newStatus = 'approved';
    }

    $sql = "UPDATE vehicle_registration SET status = '$newStatus' WHERE registration_number = '$id'";
    $conn->query($sql);
    header("Location: view_vehicle.php");
    exit;
}

function deletevehicleApplication($conn, $id)
{
    $sql = "DELETE FROM vehicle_registration WHERE registration_number = '$id'";
    $conn->query($sql);
}
?>