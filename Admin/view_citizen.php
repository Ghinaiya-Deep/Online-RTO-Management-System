<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Data</title>
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 800px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            word-wrap: break-word;
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

        td:nth-child(4) {
            width: 30%;
            /* Adjust as needed */
        }
    </style>
</head>

<body>
    <h3 style="text-align: right;">
        <a href="admin.html" style="display: inline-block; padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px; border: 2px solid #1565c0;">
            Go Main Page
        </a>
    </h3>
    <h1>Citizen Data</h1>

    <table>
        <thead>
            <tr>
                <th>Citizen Id</th>
                <th>Name</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'config.php';
            session_start();

            // Handle delete action
            if (isset($_POST['delete'])) {
                $name = $_POST['name'];
                $delete_sql = "DELETE FROM citizen WHERE user_id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("s", $name);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Record deleted successfully.";
                } else {
                    $_SESSION['error'] = "Error deleting record: " . $conn->error;
                }
                $stmt->close();

                // Redirect to the same page to refresh the content
                header("Location: view_citizen.php");
                exit();
            }

            $sql = "SELECT * FROM citizen";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["user_id"]) . "</td>
                        <td>" . htmlspecialchars($row["username"]) . "</td>
                        <td>" . htmlspecialchars($row["password"]) . "</td>
                        <td>
                            <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                                <input type='hidden' name='name' value='" . htmlspecialchars($row["user_id"]) . "'>
                                <button type='submit' name='delete' class='delete-btn'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>