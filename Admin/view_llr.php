<?php
require 'config.php';

// Check if delete action is requested
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteLLRApplication($conn, $_GET['id']);
    header("Location: view_llr.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>LLR Applications</title>
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
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
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
   
</head>

<body>
    <h1>LLR Applications</h1>
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
            <th>Aadhar Card</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>Category</th>
            <th>Upload Documents</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Action</th>
            <th>Issue Date</th>
            <th>Expiry Date</th>
        </tr>
        <?php
        require 'config.php';
        function getLLRApplications($conn)
        {

            $sql = "SELECT * FROM llr_applications";
            $result = $conn->query($sql);
            return $result;
        }
        $result = getLLRApplications($conn);


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
                echo "<td>" . $row["aadhar_card"] . "</td>";
                echo "<td>" . $row["mobile_number"] . "</td>";
                echo "<td>" . $row["email_id"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["payment_method"] . "</td>";
                echo "<td>" . $row["upload_documents"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";

                echo "<td>";
                if (isset($_GET['id']) && $_GET['id'] == $row["applicant_id"]) {
                    if (isset($_GET['status']) && $_GET['status'] == 'approved') {
                        updateLLRApplicationStatus($conn, $row["applicant_id"]);
                    } elseif (isset($_GET['status']) && $_GET['status'] == 'rejected') {
                        updateLLRApplicationStatus($conn, $row["applicant_id"]);
                    }
                }
                echo "<a href='?id=" . $row["applicant_id"] . "&status=approved' class='icon edit-icon'>Edit</a>";
                echo "<a href='?id=" . $row["applicant_id"] . "&action=delete' class='icon delete-icon'>Delete</a>";
                
                echo "</td>";
                echo "<td>" . $row["issue_learning_date"] . "</td>";
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


function updateLLRApplicationStatus($conn, $id)
{
    $sql = "SELECT status FROM llr_applications WHERE applicant_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $currentStatus = $row["status"];
    if ($currentStatus == 'approved') {
        $newStatus = 'pending';
    } else {
        $newStatus = 'approved';
    }

    $date = date("Y-m-d");
    $expiry_date = date('Y-m-d', strtotime('+6 months'));
    $sql = "UPDATE llr_applications SET status='approved', issue_learning_date='$date', expiry_date='$expiry_date' WHERE applicant_id=$id";
    $conn->query($sql);
}

function deleteLLRApplication($conn, $id)
{
    $sql = "DELETE FROM llr_applications WHERE applicant_id = '$id'";
    $conn->query($sql);
}
?>