<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:560px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:2rem; text-align:center;">
            <div style="font-size:2rem;">🧾</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">Biruwa</h1>
            <p style="color:#dcfce7; font-size:0.85rem; margin:0.25rem 0 0;">Your Invoice</p>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917; margin:0 0 0.25rem;">
                Hi {{ $order->customer_name }},
            </p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6; margin:0 0 1.5rem;">
                @if($order->payment_method === 'cod')
                    Your order has been delivered and payment received. Your invoice is attached to this email.
                @else
                    Thank you for your payment. Your invoice is attached to this email.
                @endif
            </p>

            <table style="width:100%; font-size:0.85rem; color:#44403c; margin-bottom:1.5rem; border-collapse:collapse;">
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Invoice No.</td>
                    <td style="padding:4px 0; text-align:right; font-weight:700;">{{ $order->invoice_no }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Order ID</td>
                    <td style="padding:4px 0; text-align:right;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td style="padding:4px 0; color:#78716c;">Total Paid</td>
                    <td style="padding:4px 0; text-align:right; font-weight:700;">Rs. {{ number_format($order->total, 2) }}</td>
                </tr>
            </table>

            <p style="font-size:0.85rem; color:#78716c; line-height:1.6; margin:0;">
                The full itemized invoice is attached as a PDF. Thanks for shopping with Biruwa 🌿
            </p>
        </div>
    </div>
</body>
</html>