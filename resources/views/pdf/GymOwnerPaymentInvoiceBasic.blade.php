<!DOCTYPE html>
<html>
<head>
    <style>
        /* Define your invoice styles here */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .invoice {
            margin: 20px auto;
            width: 600px;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            margin: 0;
            font-size: 24px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details .row {
            display: flex;
            justify-content: space-between;
        }
        .invoice-details .row span {
            font-weight: bold;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .invoice-table th {
            background-color: #f5f5f5;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
        .invoice-total span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>
        <div class="invoice-details">
            <div class="row">
                <span>Invoice Number:</span>
                <span></span>
            </div>
            <div class="row">
                <span>Date:</span>
                <span>{{ $date }}</span>
            </div>
            <!-- Add more invoice details as needed -->
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Payment Id</th>
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Commission</th>
                    <th>Profit</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->gym_owner->user->name}}</td>
                        <td>{{ $item->amount}}</td>
                        <td>{{ $item->commission }}</td>
                        <td>{{ $item->profit }}</td>
                        <td>{{ $item->payment_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="invoice-total">
            <span>Total Amount:</span>
            <span>{{ $totalAmount }}</span>
        </div>
    </div>
</body>
</html>
