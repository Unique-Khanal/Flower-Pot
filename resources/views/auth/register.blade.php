<x-guest-layout>

    <div class="text-center mb-7">
        <h1 class="text-2xl font-bold text-stone-800">Create Account 🌱</h1>
        <p class="text-stone-500 text-sm mt-1">Join FlowerPot and bring nature home</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Full Name
            </label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <input id="name" type="text" name="name"
                       value="{{ old('name') }}"
                       class="auth-input {{ $errors->has('name') ? 'border-red-400' : '' }}"
                       placeholder="Your full name"
                       required autofocus autocomplete="name">
            </div>
            @if($errors->has('name'))
                <div style="margin-top:0.5rem; background:#fef2f2; border:1px solid #fecaca;
                            border-radius:0.75rem; padding:0.6rem 1rem;">
                    @foreach($errors->get('name') as $error)
                        <p style="font-size:0.78rem; color:#b91c1c;
                                  display:flex; align-items:center; gap:0.4rem; margin:0;">
                            <span style="font-weight:700; flex-shrink:0;">✕</span> {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Gender -->
        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-2">Gender</label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="gender" value="male"
                           class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500"
                           {{ old('gender') == 'male' ? 'checked' : '' }} required>
                    <span class="text-sm text-stone-700 font-medium">Male</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="gender" value="female"
                           class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500"
                           {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <span class="text-sm text-stone-700 font-medium">Female</span>
                </label>
            </div>
            @if($errors->has('gender'))
                <div style="margin-top:0.5rem; background:#fef2f2; border:1px solid #fecaca;
                            border-radius:0.75rem; padding:0.6rem 1rem;">
                    @foreach($errors->get('gender') as $error)
                        <p style="font-size:0.78rem; color:#b91c1c;
                                  display:flex; align-items:center; gap:0.4rem; margin:0;">
                            <span style="font-weight:700; flex-shrink:0;">✕</span> {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Email Address
            </label>
            <p style="font-size:0.72rem; color:#78716c; margin-bottom:0.4rem;">
                Must contain @ symbol with alphanumeric characters.
            </p>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{-- type="text" so browser does NOT intercept and Laravel validates --}}
                <input id="email" type="text" name="email"
                       value="{{ old('email') }}"
                       class="auth-input {{ $errors->has('email') ? 'border-red-400' : '' }}"
                       placeholder="enter valid email"
                       autocomplete="username"
                       oninput="validateEmail(this.value)">
            </div>

            {{-- Live feedback --}}
            <p id="email-live-error"
               style="display:none; font-size:0.75rem; color:#b91c1c;
                      margin-top:0.35rem; align-items:center; gap:0.3rem;">
            </p>
            <p id="email-live-ok"
               style="display:none; font-size:0.75rem; color:#15803d; margin-top:0.35rem;">
            </p>

            {{-- Server side errors --}}
            @if($errors->has('email'))
                <div style="margin-top:0.5rem; background:#fef2f2; border:1px solid #fecaca;
                            border-radius:0.75rem; padding:0.6rem 1rem;">
                    <p style="font-size:0.78rem; font-weight:700; color:#b91c1c;
                               margin:0 0 0.3rem 0;">⚠️ Email issue:</p>
                    @foreach($errors->get('email') as $error)
                        <p style="font-size:0.78rem; color:#b91c1c;
                                  display:flex; align-items:center; gap:0.4rem; margin:0;">
                            <span style="font-weight:700; flex-shrink:0;">✕</span> {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Password
            </label>
            <p style="font-size:0.72rem; color:#78716c; margin-bottom:0.5rem;">
                Must be 8+ characters with uppercase, lowercase, number and symbol
            </p>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input id="password" type="password" name="password"
                       class="auth-input {{ $errors->has('password') ? 'border-red-400' : '' }}"
                       placeholder="Create a strong password"
                       required autocomplete="new-password"
                       oninput="checkStrength(this.value)">
                <button type="button"
                        onclick="togglePassword('password', this)"
                        style="position:absolute; right:0.75rem; top:50%;
                               transform:translateY(-50%); background:none;
                               border:none; cursor:pointer; color:#78716c;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            {{-- Strength bar --}}
            <div style="margin-top:0.5rem; height:4px; background:#e7e5e0;
                        border-radius:999px; overflow:hidden;">
                <div id="strength-bar"
                     style="height:100%; width:0%; border-radius:999px; transition:all 0.3s;">
                </div>
            </div>
            <p id="strength-text" style="font-size:0.7rem; margin-top:0.25rem;"></p>

            @if($errors->has('password'))
                <div style="margin-top:0.5rem; background:#fef2f2; border:1px solid #fecaca;
                            border-radius:0.75rem; padding:0.75rem 1rem;">
                    <p style="font-size:0.78rem; font-weight:700; color:#b91c1c; margin:0 0 0.4rem 0;">
                        ⚠️ Password must have all of these:
                    </p>
                    <ul style="list-style:none; padding:0; margin:0;
                               display:flex; flex-direction:column; gap:0.3rem;">
                        @foreach($errors->get('password') as $error)
                            <li style="font-size:0.78rem; color:#b91c1c;
                                       display:flex; align-items:flex-start; gap:0.4rem;">
                                <span style="color:#ef4444; font-weight:700; flex-shrink:0;">✕</span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation"
                   class="block text-sm font-semibold text-stone-700 mb-1.5">
                Confirm Password
            </label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="auth-input {{ $errors->has('password_confirmation') ? 'border-red-400' : '' }}"
                       placeholder="Repeat your password"
                       required autocomplete="new-password"
                       oninput="checkMatch()">
                <button type="button"
                        onclick="togglePassword('password_confirmation', this)"
                        style="position:absolute; right:0.75rem; top:50%;
                               transform:translateY(-50%); background:none;
                               border:none; cursor:pointer; color:#78716c;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            <p id="match-text"
               style="font-size:0.72rem; margin-top:0.3rem; display:none;"></p>

            @if($errors->has('password_confirmation'))
                <div style="margin-top:0.5rem; background:#fef2f2; border:1px solid #fecaca;
                            border-radius:0.75rem; padding:0.6rem 1rem;">
                    @foreach($errors->get('password_confirmation') as $error)
                        <p style="font-size:0.78rem; color:#b91c1c;
                                  display:flex; align-items:center; gap:0.4rem; margin:0;">
                            <span style="font-weight:700; flex-shrink:0;">✕</span> {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn">
            Create Account →
        </button>

        <p class="text-center text-sm text-stone-500 pt-1">
            Already have an account?
            <a href="{{ route('login') }}"
               class="text-green-700 font-semibold hover:text-green-900 transition">
                Sign in
            </a>
        </p>

    </form>

    <script>
        // ── Show/hide password ──────────────────────────────
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            input.type  = input.type === 'password' ? 'text' : 'password';
            btn.style.color = input.type === 'text' ? '#15803d' : '#78716c';
        }

        // ── Live email validation ───────────────────────────
        function validateEmail(val) {
            const errEl = document.getElementById('email-live-error');
            const okEl  = document.getElementById('email-live-ok');

            if (val.length === 0) {
                errEl.style.display = 'none';
                okEl.style.display  = 'none';
                return;
            }

            const regex = /^[a-zA-Z0-9][a-zA-Z0-9._%+\-]*@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;

            if (!val.includes('@')) {
                errEl.innerHTML     = '✕ Email must contain @ symbol.';
                errEl.style.display = 'flex';
                okEl.style.display  = 'none';
                return;
            }

            const parts = val.split('@');
            if (parts[0].length === 0) {
                errEl.innerHTML     = '✕ Email must have characters before @';
                errEl.style.display = 'flex';
                okEl.style.display  = 'none';
                return;
            }

            if (!/[a-zA-Z]/.test(parts[0])) {
                errEl.innerHTML     = '✕ Email username must contain alphabetic characters';
                errEl.style.display = 'flex';
                okEl.style.display  = 'none';
                return;
            }

            if (!regex.test(val)) {
                errEl.innerHTML     = '✕ Invalid format. Use correct format.';
                errEl.style.display = 'flex';
                okEl.style.display  = 'none';
                return;
            }

            errEl.style.display = 'none';
            okEl.innerHTML      = '✓ Valid email address';
            okEl.style.display  = 'block';
        }

        // ── Password strength checker ───────────────────────
        function checkStrength(val) {
            const bar  = document.getElementById('strength-bar');
            const text = document.getElementById('strength-text');
            let score  = 0;
            if (val.length >= 8)            score++;
            if (/[A-Z]/.test(val))          score++;
            if (/[a-z]/.test(val))          score++;
            if (/[0-9]/.test(val))          score++;
            if (/[^A-Za-z0-9]/.test(val))   score++;

            const levels = [
                { w:'0%',   color:'transparent', label:'' },
                { w:'20%',  color:'#ef4444',     label:'Very weak' },
                { w:'40%',  color:'#f97316',     label:'Weak' },
                { w:'60%',  color:'#eab308',     label:'Fair' },
                { w:'80%',  color:'#22c55e',     label:'Strong' },
                { w:'100%', color:'#15803d',     label:'Very strong ✓' },
            ];

            bar.style.width      = levels[score].w;
            bar.style.background = levels[score].color;
            text.textContent     = levels[score].label;
            text.style.color     = levels[score].color;
        }

        // ── Password match checker ──────────────────────────
        function checkMatch() {
            const pass    = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const text    = document.getElementById('match-text');
            if (confirm.length === 0) {
                text.style.display = 'none';
                return;
            }
            text.style.display = 'block';
            if (pass === confirm) {
                text.textContent = '✓ Passwords match';
                text.style.color = '#15803d';
            } else {
                text.textContent = '✕ Passwords do not match';
                text.style.color = '#b91c1c';
            }
        }
    </script>

</x-guest-layout>