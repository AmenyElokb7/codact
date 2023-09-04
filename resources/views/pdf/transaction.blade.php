<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
    <style>
        body {
            text-align: center;
        }

        .center {
            display: flex;
            justify-content: center;
        }

        .transaction-details {
            border: 2px solid #000;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="transaction-details">
      
        <div class="center">
            <h1>Transaction Details</h1>
        </div>
        <div class="center">
            <p><strong>Transaction ID:</strong> {{ $transaction['id'] }}</p>
        </div>
        <div class="center">
            <p><strong>Title:</strong> {{ $transaction['title'] }}  </p>
        </div>
        <div class="center">
            <p><strong>Description:</strong> {{ $transaction['description'] }}  </p>
        </div>
        <div class="center">
            <p><strong>Amount:</strong> {{ number_format($transaction['amount'], 2) }} DNT</p>
        </div>
        <div class="center">
            <p><strong>User Name:</strong> {{ $receiver_name }}</p>
        </div>
 
        <div class="center">
            <p><strong>Date:</strong> {{ date('Y-m-d', strtotime($transaction['created_at'])) }}</p>
        </div>
        <div class="center">
            <p><strong>Time:</strong> {{ date('H:i:s', strtotime($transaction['created_at'])) }}</p>
        </div>
    </div>
</body>
</html>