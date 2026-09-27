<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:480px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:2rem; text-align:center;">
            <div style="font-size:2.5rem;">💰</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">Biruwa</h1>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917;">Hi {{ $payout->vendor->user->name }},</p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6;">
                Your payout for <strong>{{ $payout->vendor->business_name }}</strong> has been sent to your bank account on file.
            </p>

            <div style="background:#f0fdf4; border:2px dashed #86efac; border-radius:12px; padding:1.5rem; margin:1.5rem 0;">
                <table style="width:100%; font-size:0.85rem; color:#3f3f46; border-collapse:collapse;">
                    <tr>
                        <td style="padding:4px 0; color:#78716c;">Period</td>
                        <td style="padding:4px 0; text-align:right; font-weight:600;">
                            {{ $payout->period_start->format('M j, Y') }} – {{ $payout->period_end->format('M j, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px 0; color:#78716c;">Total Sales</td>
                        <td style="padding:4px 0; text-align:right;">Rs. {{ number_format($payout->total_sales, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:4px 0; color:#78716c;">Commission Deducted</td>
                        <td style="padding:4px 0; text-align:right;">− Rs. {{ number_format($payout->commission_deducted, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0 0; border-top:1px solid #d1d5db; font-weight:700; color:#166534;">Amount Paid</td>
                        <td style="padding:10px 0 0; border-top:1px solid #d1d5db; text-align:right; font-weight:700; color:#166534; font-size:1.1rem;">
                            Rs. {{ number_format($payout->payout_amount, 2) }}
                        </td>
                    </tr>
                </table>
            </div>

            <p style="font-size:0.8rem; color:#a8a89b;">
                Paid to: {{ $payout->vendor->bank_name ?? 'your bank on file' }}
                @if($payout->vendor->bank_account_no)
                    &middot; A/C ending {{ substr($payout->vendor->bank_account_no, -4) }}
                @endif
                <br>
                If you don't see it in your account within a couple of business days, please reach out to us.
            </p>
        </div>

        <div style="background:#f5f5f4; padding:1rem; text-align:center;">
            <p style="font-size:0.75rem; color:#a8a29e; margin:0;">
                🌿 Biruwa — Kathmandu, Nepal
            </p>
        </div>
    </div>
</body>
</html>