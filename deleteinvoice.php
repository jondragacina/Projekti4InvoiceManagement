<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Invoice</title>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .alert {
            text-align: center;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 10px;
        }

        
        @media (max-width: 768px) {
            .container {
                margin-top: 30px;
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn-secondary {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 1.2rem;
            }

            .btn-secondary {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Delete Invoice</h2>
    <?php
    $connection = new mysqli("localhost", "root", "", "invoice_management");

    if ($connection->connect_error) {
        die("<div class='alert alert-danger'>Connection failed: " . $connection->connect_error . "</div>");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $stmt = $connection->prepare("DELETE FROM invoices WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Invoice deleted successfully!</div>";
                echo "<a class='btn btn-secondary mt-3' href='dashboard.php'>Back to Dashboard</a>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Invalid request! Please ensure the form is submitted correctly.</div>";
        }
    }

    $connection->close();
    ?>
</div>

</body>
</html>
