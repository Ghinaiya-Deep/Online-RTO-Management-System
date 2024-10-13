<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Table</title>
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

        .delete-btn {
            color: white;
            background-color: gray;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <h1>Complaints </h1>
    <table>
        <thead>
            <tr>
                <th>Complainter Name</th>
                <th>Complaint Date</th>
                <th>Complaint Description</th>
                <th>Complaint Document</th>
                <th>Complainter Mobile Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'config.php';
            session_start();

            // Handle delete action
            if (isset($_GET['delete'])) {
                $name = $conn->real_escape_string($_GET['delete']);
                $delete_sql = "DELETE FROM complaint WHERE complainter_name = '$name'";
                if ($conn->query($delete_sql) === TRUE) {
                    $_SESSION['message'] = "Complaint deleted successfully.";
                } else {
                    $_SESSION['message'] = "Error deleting record: " . $conn->error;
                }
                header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
                exit();
            }

            if (isset($_SESSION['message'])) {
                echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
                unset($_SESSION['message']);
            }

            $sql = "SELECT * FROM complaint";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($row["complainter_name"]) . "</td>
                    <td>" . htmlspecialchars($row["complaint_date"]) . "</td>
                    <td>" . htmlspecialchars($row["complaint_description"]) . "</td>
                    <td>" . htmlspecialchars($row["complaint_doc"]) . "</td>
                    <td>" . htmlspecialchars($row["complainter_mobile"]) . "</td>
                    <td>
                        <form method='get' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                                <input type='hidden' name='delete' value='" . htmlspecialchars($row["complainter_name"]) . "'>
                                <button type='submit' class='delete-btn'>Delete</button>
                            </form>
                    </td>
                    </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>