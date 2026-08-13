<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:560px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:2rem; text-align:center;">
            <div style="font-size:2rem;">🌿</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">Biruwa</h1>
            <p style="color:#dcfce7; font-size:0.85rem; margin:0.25rem 0 0;">Order Confirmation</p>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917; margin:0 0 0.25rem;">
                Hi {{ $order->customer_name }},
            </p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6; margin:0 0 1.5rem;">
                Thanks for your order! Here's your order slip for reference.
            </p>

            {{-- Order meta --}}
            <table style="width:100%; font-size:0.85rem; color:#44403c; margin-bottom:1.5rem; border-collapse:collapse;">
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Order ID</td>
                    <td style="padding:4px 0; text-align:right; font-weight:700;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Order Date</td>
                    <td style="padding:4px 0; text-align:right;">{{ $order->created_at->format('M d, Y — h:i A') }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Payment Method</td>
                    <td style="padding:4px 0; text-align:right; text-transform:uppercase;">{{ $order->payment_method }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Payment Status</td>
                    <td style="padding:4px 0; text-align:right;">
                        <span style="background:{{ $order->payment_status === 'paid' ? '#dcfce7' : '#fef3c7' }};
                                     color:{{ $order->payment_status === 'paid' ? '#15803d' : '#a16207' }};
                                     padding:2px 10px; border-radius:999px; font-size:0.75rem; font-weight:700;
                                     text-transform:uppercase;">
                            {{ $order->payment_status === 'paid' ? 'Paid' : 'Pay on Delivery' }}
                        </span>
                    </td>
                </tr>
            </table>

            {{-- Items --}}
            <table style="width:100%; border-collapse:collapse; margin-bottom:1rem;">
                <thead>
                    <tr style="border-bottom:2px solid #166534;">
                        <th style="text-align:left; padding:8px 4px; font-size:0.75rem; color:#166534; text-transform:uppercase;">Item</th>
                        <th style="text-align:center; padding:8px 4px; font-size:0.75rem; color:#166534; text-transform:uppercase;">Qty</th>
                        <th style="text-align:right; padding:8px 4px; font-size:0.75rem; color:#166534; text-transform:uppercase;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr style="border-bottom:1px solid #f5f5f4;">
                            <td style="padding:10px 4px; font-size:0.85rem; color:#1c1917;">
                                {{ $item->product_name }}
                                @if ($item->vendor)
                                    <br><span style="font-size:0.7rem; color:#a8a29e;">Sold by {{ $item->vendor->business_name }}</span>
                                @endif
                            </td>
                            <td style="padding:10px 4px; text-align:center; font-size:0.85rem; color:#57534e;">{{ $item->quantity }}</td>
                            <td style="padding:10px 4px; text-align:right; font-size:0.85rem; color:#1c1917;">Rs. {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Totals --}}
            <table style="width:100%; font-size:0.85rem; margin-bottom:1.5rem;">
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Subtotal</td>
                    <td style="padding:4px 0; text-align:right;">Rs. {{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Delivery Charge</td>
                    <td style="padding:4px 0; text-align:right;">Rs. {{ number_format($order->delivery_charge, 2) }}</td>
                </tr>
                <tr style="border-top:2px solid #166534;">
                    <td style="padding:8px 0 0; font-weight:700; color:#1c1917;">Total</td>
                    <td style="padding:8px 0 0; text-align:right; font-weight:700; color:#166534; font-size:1rem;">Rs. {{ number_format($order->total, 2) }}</td>
                </tr>
            </table>

            {{-- Delivery address --}}
            <div style="background:#f0fdf4; border-radius:12px; padding:1rem; margin-bottom:1.5rem;">
                <p style="font-size:0.75rem; color:#166534; text-transform:uppercase; font-weight:700; margin:0 0 0.35rem;">Delivering To</p>
                <p style="font-size:0.85rem; color:#44403c; margin:0; line-height:1.5;">
                    {{ $order->address }}<br>
                    📞 {{ $order->phone_no }}
                </p>
            </div>

            <p style="font-size:0.8rem; color:#a8a29e; text-align:center;">
                You can track this order anytime from your
                <a href="{{ route('orders.index') }}" style="color:#15803d;">order history</a>.
            </p>
        </div>

        <div style="background:#f5f5f4; padding:1rem; text-align:center;">
            <p style="font-size:0.75rem; color:#a8a29e; margin:0;">© {{ date('Y') }} Biruwa. All rights reserved.</p>
        </div>

    </div>
</body>
</html>