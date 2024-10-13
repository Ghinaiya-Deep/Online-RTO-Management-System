<?php
require 'config.php';

// Check if delete action is requested
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteDLApplication($conn, $_GET['id']);
    header("Location: view_dl.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>DL Applications</title>
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
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

</head>

<body>
    <h1>DL Applications</h1>
    <table>
        <tr>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Father Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>License Type</th>
            <th>Vehicle Class</th>
            <th>Payment Method</th>
            <th>Upload Documents</th>
            <th>Status</th>
            <th>Action</th>
            <th>Issue Date</th>
            <th>Expiry Date</th>
        </tr>
        <?php
        require 'config.php';
        function getDLApplications($conn)
        {

            $sql = "SELECT * FROM dl_applications";
            $result = $conn->query($sql);
            return $result;
        }
        $result = getDLApplications($conn);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["applicant_id"] . "</td>";
                echo "<td>" . $row["applicant_name"] . "</td>";
                echo "<td>" . $row["father_name"] . "</td>";
                echo "<td>" . $row["date_of_birth"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                echo "<td>" . $row["pincode"] . "</td>";
                echo "<td>" . $row["mobile_number"] . "</td>";
                echo "<td>" . $row["email_id"] . "</td>";
                echo "<td>" . $row["license_type"] . "</td>";
                echo "<td>" . $row["vehicle_class"] . "</td>";
                echo "<td>" . $row["payment_method"] . "</td>";
                echo "<td>" . $row["upload_documents"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>";
                if (isset($_GET['id']) && $_GET['id'] == $row["applicant_id"]) {
                    if (isset($_GET['status']) && $_GET['status'] == 'approved') {
                        updateDLApplicationStatus($conn, $row["applicant_id"]);
                    } elseif (isset($_GET['status']) && $_GET['status'] == 'rejected') {
                        updateDLApplicationStatus($conn, $row["applicant_id"]);
                    }
                }
                echo "<a href='?id=" . $row["applicant_id"] . "&status=approved' class='icon edit-icon'>Edit</a>";
                echo "<a href='?id=" . $row["applicant_id"] . "&action=delete' class='icon delete-icon'>Delete</a>";
                
                
                echo "</td>";
                echo "<td>" . $row["issue_driving_date"] . "</td>";
                echo "<td>" . $row["expiry_date"] . "</td>";
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
function updateDLApplicationStatus($conn, $id)
{
    $sql = "SELECT status FROM dl_applications WHERE applicant_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentStatus = $row["status"];

    if ($currentStatus == 'approved') {
        $newStatus = 'pending';
    } else {
        $newStatus = 'approved';

        $date = date("Y-m-d");
        $expiry_date = date('Y-m-d', strtotime('+21 years'));
        $sql = "UPDATE dl_applications SET status='approved', issue_driving_date='$date', expiry_date='$expiry_date' WHERE applicant_id=$id";
        $conn->query($sql);
    }

    $sql = "UPDATE dl_applications SET status = '$newStatus' WHERE applicant_id = '$id'";
    $conn->query($sql);
    header("Location: view_dl.php");
    exit;
}

function deleteDLApplication($conn, $id)
{
    $sql = "DELETE FROM dl_applications WHERE applicant_id = '$id'";
    $conn->query($sql);
}
?>