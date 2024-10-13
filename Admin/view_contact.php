<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Table</title>
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
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
    <h1>Contact Us</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Email</th>
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
                $delete_sql = "DELETE FROM contact_us WHERE name = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("s", $name);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Record deleted successfully.";
                } else {
                    $_SESSION['error'] = "Error deleting record: " . $conn->error;
                }
                $stmt->close();

                // Redirect to the same page to refresh the content
                header("Location: view_contact.php");
                exit();
            }

            $sql = "SELECT * FROM contact_us";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["subject"]) . "</td>
                        <td>" . htmlspecialchars($row["message"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>
                            <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                                <input type='hidden' name='name' value='" . htmlspecialchars($row["name"]) . "'>
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
