<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin:0; padding:0; background:#f0fdf4; font-family:sans-serif;">
    <div style="max-width:480px; margin:40px auto; background:white; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <div style="background:linear-gradient(135deg,#166534,#15803d); padding:2rem; text-align:center;">
            <div style="font-size:2.5rem;">🎉</div>
            <h1 style="color:white; font-size:1.3rem; margin:0.5rem 0 0;">Biruwa</h1>
        </div>

        <div style="padding:2rem;">
            <p style="font-size:1rem; color:#1c1917;">Hi {{ $vendor->user->name }},</p>
            <p style="font-size:0.9rem; color:#57534e; line-height:1.6;">
                Great news — your vendor application for
                <strong>{{ $vendor->business_name }}</strong> has been reviewed and
                <strong style="color:#166534;">approved</strong>! You can now log in
                to your vendor dashboard and start listing products on Biruwa.
            </p>

            <div style="background:#f0fdf4; border:2px dashed #86efac; border-radius:12px;
                        padding:1.5rem; text-align:center; margin:1.5rem 0;">
                <a href="{{ route('vendor.login') }}"
                   style="display:inline-block; background:#166534; color:white;
                          font-weight:700; padding:0.75rem 2rem; border-radius:0.75rem;
                          text-decoration:none; font-size:0.9rem;">
                    Log In to Your Dashboard
                </a>
            </div>

            <p style="font-size:0.8rem; color:#a8a89b;">
                For your security, we'll send a one-time verification code to this
                email address the first time you log in.
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