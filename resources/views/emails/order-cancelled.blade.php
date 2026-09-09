<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#fef2f2; font-family:sans-serif;">
    <div style="max-width:560px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#991b1b,#b91c1c); padding:2rem; text-align:center;">
            <div style="font-size:2rem;">✕</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">Biruwa</h1>
            <p style="color:#fecaca; font-size:0.85rem; margin:0.25rem 0 0;">Order Cancelled</p>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917; margin:0 0 0.25rem;">
                Hi {{ $order->customer_name }},
            </p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6; margin:0 0 1.5rem;">
                We're sorry — your order below has been cancelled and will not be delivered.
                @if($order->payment_status === 'paid')
                    Since this order was already paid, our team will contact you shortly about your refund.
                @endif
            </p>

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
                    <td style="padding:4px 0; color:#78716c;">Order Total</td>
                    <td style="padding:4px 0; text-align:right; font-weight:700;">Rs. {{ number_format($order->total, 2) }}</td>
                </tr>
            </table>

            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:12px; padding:1rem 1.25rem; margin-bottom:1.5rem;">
                <p style="font-size:0.75rem; font-weight:700; color:#991b1b; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 0.4rem;">
                    Reason for cancellation
                </p>
                <p style="font-size:0.9rem; color:#7f1d1d; margin:0; line-height:1.5;">
                    {{ $order->cancel_reason }}
                </p>
            </div>

            {{-- What was ordered --}}
            <table style="width:100%; font-size:0.85rem; border-collapse:collapse;">
                @foreach($order->items as $item)
                    <tr>
                        <td style="padding:6px 0; color:#44403c;">{{ $item->product_name }} × {{ $item->quantity }}</td>
                        <td style="padding:6px 0; text-align:right; color:#44403c;">Rs. {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </table>

            <p style="font-size:0.85rem; color:#78716c; line-height:1.6; margin-top:1.5rem;">
                If you have any questions about this cancellation, feel free to reach out to us and we'll be happy to help.
            </p>
        </div>

        <div style="background:#fafaf9; padding:1.25rem; text-align:center;">
            <p style="font-size:0.75rem; color:#a8a29e; margin:0;">
                Biruwa — घर-घरमा हरियाली 🌿
            </p>
        </div>

    </div>
</body>
</html>