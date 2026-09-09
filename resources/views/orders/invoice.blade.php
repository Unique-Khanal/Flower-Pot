<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->invoice_no }}</title>
    <style>
        body { font-family: 'DM Sans', Arial, sans-serif; color:#1B3B2F; font-size:13px; margin:0; padding:0; background:#F7F3E8; }
        .wrap { max-width:800px; margin:0 auto; padding: {{ isset($forPdf) ? '0' : '2.5rem 1.5rem' }}; }
        .card { background:#fff; border-radius: {{ isset($forPdf) ? '0' : '16px' }}; padding:32px; position:relative; overflow:hidden;
                {{ isset($forPdf) ? '' : 'box-shadow:0 1px 3px rgba(27,59,47,0.08); border:1px solid #EDE7D6;' }} }

        .accent-bar { height:5px; background:#2F6B4F; margin:-32px -32px 28px; }

        .brand { font-size:21px; font-weight:800; color:#1B3B2F; letter-spacing:-0.01em; }
        .brand span { color:#C89B3C; }
        .muted { color:#8A9088; font-size:12px; }
        h1 { font-size:12px; margin:0 0 6px; color:#8A9088; letter-spacing:.12em; text-transform:uppercase; font-weight:700; }
        .invoice-no { font-size:17px; font-weight:800; color:#1B3B2F; }

        h3 { font-size:10.5px; text-transform:uppercase; letter-spacing:.1em; color:#8A9088; margin:0 0 8px; font-weight:700; }
        .name { font-weight:700; color:#1B3B2F; margin-bottom:2px; }

        table { width:100%; border-collapse:collapse; margin-bottom:22px; }
        th { background:#F7F3E8; text-align:left; font-size:10.5px; text-transform:uppercase; letter-spacing:.06em; color:#5A6B5C; padding:10px 12px; font-weight:700; }
        th:first-child { border-radius:8px 0 0 8px; }
        th:last-child { border-radius:0 8px 8px 0; }
        td { padding:11px 12px; border-bottom:1px solid #F3EFE2; font-size:12.5px; color:#3F5C4A; }
        .item-name { font-weight:600; color:#1B3B2F; }

        .totals { width:280px; margin-left:auto; }
        .totals td { border:none; padding:5px 12px; }
        .totals .final td { font-weight:800; font-size:16px; border-top:2px solid #1B3B2F; color:#1B3B2F; padding-top:12px; }

        .badge { display:inline-block; padding:4px 12px; border-radius:999px; font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:.04em; }
        .badge-paid     { background:#E8F5EC; color:#216B39; }
        .badge-pending  { background:#FDF3E0; color:#946C10; }
        .badge-failed   { background:#FDEAEA; color:#B3261E; }
        .badge-refunded { background:#F1EAFB; color:#6B3FB8; }

        .stamp {
            position:absolute; top:70px; right:40px; transform:rotate(-14deg);
            border:3px solid #216B39; color:#216B39; font-weight:900; font-size:22px;
            letter-spacing:.15em; padding:6px 18px; border-radius:10px; opacity:.16;
            text-transform:uppercase;
        }

        .footer { margin-top:32px; padding-top:20px; border-top:1px solid #EDE7D6; text-align:center; color:#8A9088; font-size:11px; line-height:1.7; }

        @if(!isset($forPdf))
        .print-btn { text-align:right; margin-bottom:16px; }
        .print-btn a { background:#2F6B4F; color:#fff; text-decoration:none; padding:9px 18px; border-radius:10px; font-size:12.5px; font-weight:700; margin-left:8px; display:inline-block; }
        .print-btn a.secondary { background:#F0F3EE; color:#1B3B2F; }
        @endif
    </style>
</head>
<body>
<div class="wrap">

    @if(!isset($forPdf))
    <div class="print-btn">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.orders.invoice.download', $order) }}">⬇ Download PDF</a>
            <a href="{{ route('admin.orders.index') }}" class="secondary">← Back to All Orders</a>
        @else
            <a href="{{ route('orders.invoice.download', $order) }}">⬇ Download PDF</a>
            <a href="{{ route('orders.index') }}" class="secondary">← Back to My Orders</a>
        @endif
    </div>
    @endif

    <div class="card">
        <div class="accent-bar"></div>

        @if ($order->payment_status === 'paid')
            <div class="stamp">Paid</div>
        @endif

        <table style="width:100%; border-bottom:1px solid #EDE7D6; padding-bottom:18px; margin-bottom:22px;">
            <tr>
                <td style="border:none; padding:0; vertical-align:top;">
                    @if($logoData)
                        <img src="{{ $logoData }}" style="height:38px; width:auto; display:block;" alt="Biruwa">
                    @else
                        <div class="brand">Biru<span>wa</span></div>
                    @endif
                    <div class="muted" style="margin-top:6px;">घर-घरमा हरियाली &middot; Kathmandu, Nepal</div>
                </td>
                <td style="border:none; padding:0; vertical-align:top; text-align:right;">
                    <h1>Invoice</h1>
                    <div class="invoice-no">{{ $order->invoice_no }}</div>
                    <div class="muted">{{ $order->created_at->format('d M Y') }}</div>
                </td>
            </tr>
        </table>

        <table style="width:100%; margin-bottom:24px;">
            <tr>
                <td style="border:none; padding:0; vertical-align:top; width:60%;">
                    <h3>Billed To</h3>
                    <div class="name">{{ $order->customer_name }}</div>
                    <div class="muted">{{ $order->email }}</div>
                    <div class="muted">{{ $order->phone_no }}</div>
                    <div class="muted">{{ $order->address }}</div>
                </td>
                <td style="border:none; padding:0; vertical-align:top; width:40%; text-align:right;">
                    <h3>Payment</h3>
                    <span class="badge badge-{{ $order->payment_status }}">{{ strtoupper($order->payment_method) }} &middot; {{ $order->payment_status }}</span>
                    @if($order->gateway_ref)
                        <div class="muted" style="margin-top:8px;">Ref: {{ $order->gateway_ref }}</div>
                    @endif
                    @if($order->payment_status === 'refunded' && $order->refund_amount)
                        <div class="muted" style="margin-top:4px;">Refunded: Rs. {{ number_format($order->refund_amount, 2) }}</div>
                    @endif
                </td>
            </tr>
        </table>

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
                        <td class="item-name">{{ $item->product_name }}</td>
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
            Thank you for shopping with Biruwa 🌿<br>
            This is a computer-generated invoice and does not require a signature.
        </div>
    </div>
</div>
</body>
</html>