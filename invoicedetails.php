<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th {
            width: 30%;
            text-align: left;
            background-color: #e9ecef;
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #dee2e6;
            margin: 30px 0;
        }

        .btn-secondary {
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
            padding: 10px;
        }

        .alert {
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn-secondary {
                width: 100%;
                font-size: 1.1rem;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.2rem;
            }

            .btn-secondary {
                font-size: 1rem;
                padding: 12px;
            }

            table {
                font-size: 0.85rem;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            th, td {
                padding: 6px;
            }

            hr {
                margin: 20px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Invoice Details</h1>
        <?php
        $connection = new mysqli("localhost", "root", "", "invoice_management");

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

      
        $result = $connection->query("SELECT * FROM invoices");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Invoice ID:</th>
                            <td><?php echo $row['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Client Name:</th>
                            <td><?php echo $row['client_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Items:</th>
                            <td><?php echo nl2br($row['items']); ?></td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td><?php echo $row['amount']; ?></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                        <tr>
                            <th>Due Date:</th>
                            <td><?php echo $row['due_date']; ?></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?php
            }
        } else {
            echo "<div class='alert alert-danger'>No invoices found!</div>";
        }

        $connection->close();
        ?>
        <a class="btn btn-secondary" href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
