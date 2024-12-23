<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Add Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
            font-size: 2rem;
        }

        .btn-secondary {
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
        }

        .alert {
            text-align: center;
        }

        .back-to-dashboard {
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
                margin-top: 15px;
            }

            .form-container h1 {
                font-size: 1.8rem;
            }

            .btn-secondary {
                font-size: 1rem;
                padding: 12px;
            }
        }

        @media (max-width: 400px) {
            .form-container {
                padding: 15px;
            }

            .form-container h1 {
                font-size: 1.6rem;
            }

            .btn-secondary {
                font-size: 0.9rem;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Add New Invoice</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="items">Items</label>
                    <textarea class="form-control" id="items" name="items" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                </div>
                <button type="submit" class="btn btn-secondary">Add Invoice</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $connection = new mysqli("localhost", "root", "", "invoice_management");

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $client_name = $_POST['client_name'];
                $items = $_POST['items'];
                $amount = $_POST['amount'];
                $status = $_POST['status'];
                $due_date = $_POST['due_date'];

                $stmt = $connection->prepare("INSERT INTO invoices (client_name, items, amount, status, due_date) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdss", $client_name, $items, $amount, $status, $due_date);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Invoice added successfully!</div>";
                    echo "<a href='dashboard.php' class='btn btn-secondary back-to-dashboard'>Back to Dashboard</a>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                }

                $stmt->close();
                $connection->close();
            }
            ?>
        </div>
    </div>


   
</body>
</html>
