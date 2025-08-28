<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoices Report - {{ date('Y-m-d') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #000;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .summary-label {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
        }
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .amount {
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoices & Payments Report</h1>
        <p>Generated on {{ date('F d, Y') }}</p>
        <p>Total Records: {{ $invoices->count() }}</p>
    </div>

    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Revenue:</span>
            <span class="amount">A${{ number_format($invoices->count() * 500, 2) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Active Agencies:</span>
            <span>{{ $invoices->where('status', 'Approved')->count() }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Pending Payments:</span>
            <span>{{ $invoices->where('status', 'Pending')->count() }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Agency Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Plan Start</th>
                <th>Plan End</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->name }}</td>
                <td>{{ $invoice->email }}</td>
                <td class="amount">A$500.00</td>
                <td>
                    @php
                        $status = 'Pending';
                        $statusClass = 'status-pending';
                        
                        if ($invoice->plan_end_date) {
                            $planEnd = \Carbon\Carbon::parse($invoice->plan_end_date);
                            if ($invoice->status === 'Approved' && $planEnd->isFuture()) {
                                $status = 'Paid';
                                $statusClass = 'status-paid';
                            } elseif ($invoice->status === 'Inactive') {
                                $status = 'Failed';
                                $statusClass = 'status-failed';
                            }
                        }
                    @endphp
                    <span class="status {{ $statusClass }}">{{ $status }}</span>
                </td>
                <td>{{ $invoice->plan_start_date ? \Carbon\Carbon::parse($invoice->plan_start_date)->format('d-m-Y') : '-' }}</td>
                <td>{{ $invoice->plan_end_date ? \Carbon\Carbon::parse($invoice->plan_end_date)->format('d-m-Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>This report was generated automatically by the SaaS Management System</p>
        <p>&copy; {{ date('Y') }} - All rights reserved</p>
    </div>
</body>
</html>