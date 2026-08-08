<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:480px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:2rem; text-align:center;">
            <div style="font-size:2rem;">🌿</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">FlowerPot</h1>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917;">Hi {{ $userName }},</p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6;">
                Thanks for registering! Use the code below to verify your email address.
                This code expires in <strong>10 minutes</strong>.
            </p>

            <div style="background:#f0fdf4; border:2px dashed #86efac; border-radius:12px;
                        padding:1.5rem; text-align:center; margin:1.5rem 0;">
                <span style="font-size:2rem; font-weight:700; letter-spacing:0.5rem; color:#166534;">
                    {{ $otp }}
                </span>
            </div>

            <p style="font-size:0.8rem; color:#a8a29e;">
                If you didn't create a Biruwa account, you can safely ignore this email.
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