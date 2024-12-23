<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333333;
            text-align: center;
        }

        .btn {
            font-size: 14px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #117a8b;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
        }

        table th {
            background-color: #f1f1f1;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        form {
            display: inline;
        }

        button {
            cursor: pointer;
        }

      
        @media (max-width: 1024px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8em;
            }

            table th, table td {
                padding: 10px;
            }

            .btn {
                font-size: 12px;
                padding: 6px 12px;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.6em;
            }

            table th, table td {
                padding: 8px;
            }

            .btn {
                font-size: 11px;
                padding: 6px 12px;
                margin-bottom: 10px;
            }

            .container {
                margin: 10px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2em;
            }

            .btn {
                font-size: 10px;
                padding: 5px 10px;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 6px;
            }

         
            .btn {
                display: block;
                width: 100%;
                margin: 5px 0;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
<?php
$connection = new mysqli("localhost", "root", "", "invoice_management");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$result = $connection->query("SELECT * FROM invoices");

echo "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>";
echo "<div class='container mt-5'>";

echo "<a href='add_invoice.php' class='btn btn-secondary mb-4'>Add Invoice</a> ";
echo "<a href='editinvoice.php' class='btn btn-primary mb-4'>Edit Invoice</a>"; 

echo "<h1 class='mb-4'>Invoice Dashboard</h1>";
echo "<div class='table-responsive'>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th>Invoice ID</th><th>Client Name</th><th>Amount</th><th>Status</th><th>Due Date</th><th>Actions</th></tr></thead>";
echo "<tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['client_name']}</td>";
    echo "<td>{$row['amount']}</td>";
    echo "<td>{$row['status']}</td>";
    echo "<td>{$row['due_date']}</td>";
    echo "<td>
        <form action='invoicedetails.php' method='POST' style='display:inline;'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <button type='submit' class='btn btn-info btn-sm'>View</button>
        </form>
        <form action='deleteinvoice.php' method='POST' style='display:inline;'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
        </form>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
echo "</div>";  
echo "</div>";

$connection->close();
?>
</body>
</html>
