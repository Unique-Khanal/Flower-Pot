<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:480px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:1.5rem; text-align:center;">
            <p style="color:white; font-size:1.1rem; font-weight:700; margin:0;">🧑‍🌾 New Vendor Application</p>
        </div>

        <div style="padding:1.75rem;">
            <p style="font-size:0.9rem; color:#57534e; margin:0 0 1.25rem;">
                A new vendor has applied to sell on Biruwa. Review the full details and submitted photos in the admin dashboard.
            </p>

            <table style="width:100%; font-size:0.85rem; color:#44403c; margin-bottom:1.5rem; border-collapse:collapse;">
                <tr>
                    <td style="padding:5px 0; color:#78716c;">Business Name</td>
                    <td style="padding:5px 0; text-align:right; font-weight:700;">{{ $vendor->business_name }}</td>
                </tr>
                <tr>
                    <td style="padding:5px 0; color:#78716c;">Applicant</td>
                    <td style="padding:5px 0; text-align:right;">{{ $vendor->user->name }}</td>
                </tr>
                <tr>
                    <td style="padding:5px 0; color:#78716c;">Phone</td>
                    <td style="padding:5px 0; text-align:right;">{{ $vendor->business_phone }}</td>
                </tr>
                <tr>
                    <td style="padding:5px 0; color:#78716c;">Applied On</td>
                    <td style="padding:5px 0; text-align:right;">{{ $vendor->created_at->format('M d, Y — h:i A') }}</td>
                </tr>
            </table>

            <a href="{{ route('admin.vendors.index') }}"
               style="display:block; text-align:center; background:#166534; color:white;
                      font-weight:700; font-size:0.9rem; padding:0.75rem; border-radius:10px;
                      text-decoration:none;">
                Review Application →
            </a>
        </div>

        <div style="background:#f5f5f4; padding:0.85rem; text-align:center;">
            <p style="font-size:0.7rem; color:#a8a29e; margin:0;">Biruwa Admin Notifications</p>
        </div>
    </div>
</body>
</html>