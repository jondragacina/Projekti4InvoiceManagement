<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 700px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-group label {
            font-weight: bold;
            color: #495057;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 10px;
        }

        .alert {
            text-align: center;
        }

        
        @media (max-width: 768px) {
            .container {
                margin-top: 30px;
                padding: 20px;
            }

            h1 {
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

            h1 {
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
        <h1>Edit Invoice</h1>
        <?php
        $connection = new mysqli("localhost", "root", "", "invoice_management");

        if ($connection->connect_error) {
            die("<div class='alert alert-danger'>Connection failed: " . $connection->connect_error . "</div>");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $id = $_POST['id'];
            $client_name = $_POST['client_name'];
            $items = $_POST['items'];
            $amount = $_POST['amount'];
            $status = $_POST['status'];
            $due_date = $_POST['due_date'];

            $stmt = $connection->prepare("UPDATE invoices SET client_name = ?, items = ?, amount = ?, status = ?, due_date = ? WHERE id = ?");
            $stmt->bind_param("ssdssi", $client_name, $items, $amount, $status, $due_date, $id);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Invoice updated successfully!</div>";
                
                echo "<a href='invoicedetails.php?id=$id' class='btn btn-secondary mt-3'>View</a>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
          
            $result = $connection->query("SELECT * FROM invoices ORDER BY id DESC LIMIT 1");

            if ($result && $row = $result->fetch_assoc()) {
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo $row['client_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="items">Items</label>
                        <textarea class="form-control" id="items" name="items" rows="3" required><?php echo $row['items']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" value="<?php echo $row['amount']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Paid" <?php if ($row['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                            <option value="Unpaid" <?php if ($row['status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo $row['due_date']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-secondary">Update Invoice</button>
                </form>
                <?php
            } else {
                echo "<div class='alert alert-danger'>No invoices found!</div>";
            }
        }

        $connection->close();
        ?>
    </div>
</body>
</html>
