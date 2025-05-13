<!DOCTYPE html>
<html>
<head>
    <title>Receipt - Invoice #{{ $invoiceId }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Receipt for Invoice #{{ $invoiceId }}</h2>

    @if($patient)
        <p><strong>Patient Name:</strong> {{ $patient->name }}</p>
        <p><strong>Patient Email:</strong> {{ $patient->email }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Paid At</th>
                <th>Method</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $pay)
                <tr>
                    <td>{{ $pay->id }}</td>
                    <td>{{ number_format($pay->amount_paid, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($pay->created_at)->format('F d, Y h:i A') }}</td>
                    <td>{{ ucfirst($pay->paymentMethod->cardholder_name ?? 'N/A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Paid:</strong> ₱{{ number_format($payments->sum('amount_paid'), 2) }}</p>
</body>
</html>
