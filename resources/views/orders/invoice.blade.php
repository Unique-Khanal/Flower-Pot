<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->invoice_no }}</title>
    <style>
        body { font-family: 'DM Sans', Arial, sans-serif; color:#1B3B2F; font-size:13px; margin:0; padding:0; }
        .wrap { max-width:800px; margin:0 auto; padding: {{ isset($forPdf) ? '20px' : '2.5rem 1.5rem' }}; }
        .header { display:flex; justify-content:space-between; align-items:flex-start; border-bottom:2px solid #2F6B4F; padding-bottom:16px; margin-bottom:20px; }
        .brand { font-size:20px; font-weight:800; color:#1B3B2F; }
        .brand span { color:#C89B3C; }
        .muted { color:#8A9088; font-size:12px; }
        .invoice-title { text-align:right; }
        .invoice-title h1 { font-size:18px; margin:0 0 4px; color:#1B3B2F; }
        .grid { display:flex; justify-content:space-between; gap:24px; margin-bottom:20px; }
        .box { flex:1; }
        .box h3 { font-size:11px; text-transform:uppercase; letter-spacing:.08em; color:#8A9088; margin:0 0 6px; }
        table { width:100%; border-collapse:collapse; margin-bottom:20px; }
        th { background:#F7F3E8; text-align:left; font-size:11px; text-transform:uppercase; letter-spacing:.05em; color:#5A6B5C; padding:8px 10px; }
        td { padding:8px 10px; border-bottom:1px solid #EDE7D6; font-size:12.5px; }
        .totals { width:280px; margin-left:auto; }
        .totals td { border:none; padding:4px 10px; }
        .totals .final { font-weight:800; font-size:15px; border-top:2px solid #1B3B2F; color:#1B3B2F; }
        .badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:10px; font-weight:700; text-transform:uppercase; background:#EFF5EE; color:#2F6B4F; }
        .footer { margin-top:30px; text-align:center; color:#8A9088; font-size:11px; }
        @if(!isset($forPdf))
        .print-btn { text-align:right; margin-bottom:16px; }
        .print-btn a { background:#2F6B4F; color:#fff; text-decoration:none; padding:8px 16px; border-radius:8px; font-size:12px; font-weight:700; margin-left:8px; }
        @endif
    </style>
</head>
<body>
<div class="wrap">

    @if(!isset($forPdf))
    <div class="print-btn">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.orders.invoice.download', $order) }}">Download PDF</a>
            <a href="{{ route('admin.orders.index') }}" style="background:#F0F3EE;color:#1B3B2F;">Back to All Orders</a>
        @else
            <a href="{{ route('orders.invoice.download', $order) }}">Download PDF</a>
            <a href="{{ route('orders.index') }}" style="background:#F0F3EE;color:#1B3B2F;">Back to My Orders</a>
        @endif
    </div>
    @endif

    <div class="header">
        <div>
            <div class="brand">Biru<span>wa</span></div>
            <div class="muted">Kathmandu, Nepal</div>
        </div>
        <div class="invoice-title">
            <h1>Invoice</h1>
            <div class="muted">{{ $order->invoice_no }}</div>
            <div class="muted">{{ $order->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <div class="grid">
        <div class="box">
            <h3>Billed To</h3>
            <div>{{ $order->customer_name }}</div>
            <div class="muted">{{ $order->email }}</div>
            <div class="muted">{{ $order->phone_no }}</div>
            <div class="muted">{{ $order->address }}</div>
        </div>
        <div class="box">
            <h3>Payment</h3>
            <div><span class="badge">{{ strtoupper($order->payment_method) }}</span></div>
            <div class="muted" style="margin-top:6px;">Status: {{ ucfirst($order->payment_status) }}</div>
            @if($order->gateway_ref)
                <div class="muted">Ref: {{ $order->gateway_ref }}</div>
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Sold By</th>
                <th>Qty</th>
                <th>Price</th>
                <th style="text-align:right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->vendor->business_name ?? 'Biruwa' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rs. {{ number_format($item->price, 2) }}</td>
                    <td style="text-align:right;">Rs. {{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td>Subtotal</td><td style="text-align:right;">Rs. {{ number_format($order->subtotal, 2) }}</td></tr>
        @if($order->discount_amount > 0)
            <tr><td>Discount {{ $order->coupon ? '(' . $order->coupon->code . ')' : '' }}</td><td style="text-align:right;">− Rs. {{ number_format($order->discount_amount, 2) }}</td></tr>
        @endif
        <tr><td>Delivery</td><td style="text-align:right;">Rs. {{ number_format($order->delivery_charge, 2) }}</td></tr>
        <tr class="final"><td>Total Paid</td><td style="text-align:right;">Rs. {{ number_format($order->total, 2) }}</td></tr>
    </table>

    <div class="footer">
        Thank you for shopping with Biruwa — घर-घरमा हरियाली 🌿<br>
        This is a computer-generated invoice.
    </div>

</div>
</body>
</html>