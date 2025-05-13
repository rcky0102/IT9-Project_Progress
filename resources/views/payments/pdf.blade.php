<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payment Receipt - Invoice #{{ $invoice->id ?? $payment->invoice_id }}</title>
    <style>
        body { 
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        .details { 
            margin: 30px 0; 
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        .table th, .table td { 
            border: 1px solid #ddd; 
            padding: 8px; 
        }
        .table th { 
            background-color: #f2f2f2; 
        }
        .text-right { 
            text-align: right; 
        }
        .mb-4 { 
            margin-bottom: 1.5rem; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>PAYMENT RECEIPT</h2>
        <p>Issued: {{ now()->format('F j, Y') }}</p>
    </div>

    <div class="details">
        <table class="table mb-4">
            <tr>
                <th width="30%">Payment ID</th>
                <td>{{ $payment->id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Invoice Number</th>
                <td>{{ $invoice->number ?? $payment->invoice_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Payment Date</th>
                <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('F j, Y H:i') : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td>{{ $payment->paymentMethod->name ?? 'N/A' }}</td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payment for Invoice #{{ $invoice->number ?? $payment->invoice_id ?? 'N/A' }}</td>
                    <td class="text-right">${{ number_format($payment->amount_paid ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Total Paid</th>
                    <th class="text-right">${{ number_format($payment->amount_paid ?? 0, 2) }}</th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>