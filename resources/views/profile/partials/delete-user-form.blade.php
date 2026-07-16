<section class="space-y-6">
    <header>
        <p style="font-size:0.875rem; color:#78716c; line-height:1.7; margin:0;">
            Once your account is deleted, all of its resources and data will be
            permanently deleted. Before deleting your account, please download
            any data or information that you wish to retain.
        </p>
    </header>

    {{-- Hidden form that gets submitted by SweetAlert --}}
    <form method="POST" action="{{ route('profile.destroy') }}" id="delete-account-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="password" id="delete-password-input">
    </form>

    {{-- Show any password errors --}}
    @if($errors->userDeletion->has('password'))
        <div style="background:#fef2f2; border:1px solid #fecaca;
                    border-radius:0.75rem; padding:0.75rem 1rem;">
            @foreach($errors->userDeletion->get('password') as $error)
                <p style="font-size:0.8rem; color:#b91c1c; margin:0;">✕ {{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Delete Button --}}
    <button type="button"
            onclick="confirmDeleteAccount()"
            style="background:#dc2626; color:white; font-weight:700;
                   font-size:0.875rem; padding:0.75rem 1.5rem;
                   border:none; border-radius:0.75rem; cursor:pointer;
                   transition:all 0.2s; letter-spacing:0.03em;"
            onmouseover="this.style.background='#b91c1c'"
            onmouseout="this.style.background='#dc2626'">
         Delete Account
    </button>
</section>

<script>
function confirmDeleteAccount() {
    Swal.fire({
        title: '⚠️ Delete Account?',
        html: `
            <p style="color:#57534e; font-size:0.9rem; margin-bottom:1rem; line-height:1.6;">
                Once your account is deleted, <strong>all data will be permanently lost</strong>.
                Please enter your password to confirm.
            </p>
            <input type="password"
                   id="swal-password"
                   placeholder="Enter your password"
                   style="width:100%; padding:0.7rem 1rem;
                          border:1.5px solid #d6d3d1; border-radius:0.75rem;
                          font-size:0.9rem; font-family:inherit; outline:none;
                          box-sizing:border-box;"
                   onfocus="this.style.borderColor='#dc2626'"
                   onblur="this.style.borderColor='#d6d3d1'">
            <p id="swal-pwd-error"
               style="display:none; color:#dc2626; font-size:0.78rem;
                      margin-top:0.5rem; text-align:left;">
                ✕ Password is required
            </p>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete Account',
        cancelButtonText: 'Cancel — Keep Account',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#15803d',
        reverseButtons: true,
        focusCancel: true,
        customClass: {
            popup:         'rounded-2xl',
            confirmButton: 'rounded-xl',
            cancelButton:  'rounded-xl',
        },
        preConfirm: () => {
            const pwd = document.getElementById('swal-password').value;
            if (!pwd) {
                document.getElementById('swal-pwd-error').style.display = 'block';
                return false;
            }
            return pwd;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-password-input').value = result.value;
            document.getElementById('delete-account-form').submit();
        }
    });
}
</script>