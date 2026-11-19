
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plant Inventory Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #166534;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .filters {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #166534;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>

<body>

    <h1>Plant Nursery Management System</h1>
    <p class="subtitle">Plant Inventory Report</p>

    <div class="filters">
        <strong>Applied Filters:</strong><br>

        Category:
        {{ $filters['category'] ?? 'All Categories' }}<br>

        Stock Status:
        @if(($filters['stock_status'] ?? '') === 'in_stock')
            In Stock
        @elseif(($filters['stock_status'] ?? '') === 'out_of_stock')
            Out of Stock
        @else
            All Stock Statuses
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Plant Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Description</th>
                <th>Stock Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($plants as $plant)
                <tr>
                    <td>{{ $plant->plant_name }}</td>
                    <td>{{ $plant->category }}</td>
                    <td>PHP {{ number_format($plant->unit_price, 2) }}</td>
                    <td>{{ $plant->description ?: 'N/A' }}</td>
                    <td>
                        {{ $plant->stock_status === 'in_stock'
                            ? 'In Stock'
                            : 'Out of Stock' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty">
                        No plants found matching the selected filters.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('F d, Y h:i A') }}
    </div>

</body>
</html>