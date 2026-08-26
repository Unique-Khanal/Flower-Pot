@extends('layouts.app')

@section('title', 'Become a Vendor')

@section('content')
<div class="min-h-screen bg-[#F7F3E8] py-10 px-4">
  <div class="max-w-5xl mx-auto rounded-[28px] overflow-hidden shadow-[0_20px_60px_-15px_rgba(27,59,47,0.35)] lg:flex">

    {{-- LEFT — seed packet panel --}}
    <aside class="lg:w-[38%] bg-[#1B3B2F] text-[#F7F3E8] p-8 lg:p-10 relative overflow-hidden">
      <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-[#2F6B4F] opacity-40 blur-2xl"></div>
      <div class="absolute -left-10 bottom-0 w-40 h-40 rounded-full bg-[#C89B3C] opacity-20 blur-3xl"></div>

      <div class="relative">
        <p class="text-[11px] tracking-[0.25em] uppercase text-[#C89B3C] font-semibold mb-3">Vendor Application</p>
        <h1 style="font-family:'Cinzel Decorative', serif;" class="text-2xl leading-tight mb-4">
          Grow your shop<br>on Biruwa
        </h1>
        <p class="text-sm text-[#DCE6DD] leading-relaxed mb-10">
          Join a marketplace built for Nepal's plant and pottery sellers. Fill this application once —
          we'll take it from there.
        </p>

        {{-- Real sequence — 3 actual steps a vendor goes through --}}
        <ol class="space-y-6">
          <li class="flex gap-4">
            <span class="shrink-0 w-8 h-8 rounded-full border border-[#C89B3C] text-[#C89B3C] text-xs font-bold flex items-center justify-center">1</span>
            <div>
              <p class="font-semibold text-sm">Submit your application</p>
              <p class="text-xs text-[#B9C7BB] mt-0.5">Business details, sample photos, and the vendor agreement.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <span class="shrink-0 w-8 h-8 rounded-full border border-[#C89B3C] text-[#C89B3C] text-xs font-bold flex items-center justify-center">2</span>
            <div>
              <p class="font-semibold text-sm">We review it</p>
              <p class="text-xs text-[#B9C7BB] mt-0.5">Our team checks your details — usually within a few days.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <span class="shrink-0 w-8 h-8 rounded-full bg-[#C89B3C] text-[#1B3B2F] text-xs font-bold flex items-center justify-center">3</span>
            <div>
              <p class="font-semibold text-sm">Start selling</p>
              <p class="text-xs text-[#B9C7BB] mt-0.5">List your products and reach customers across Nepal.</p>
            </div>
          </li>
        </ol>

        <div class="mt-12 pt-6 border-t border-[#2F6B4F]">
          <p class="text-xs text-[#B9C7BB]">Already applied?</p>
          <a href="{{ route('vendor.login') }}" class="text-sm font-semibold text-[#F7F3E8] underline decoration-[#C89B3C] underline-offset-4">
            Log in to check your status →
          </a>
        </div>
      </div>
    </aside>

    {{-- RIGHT — the form --}}
    <div class="lg:w-[62%] bg-white p-8 lg:p-10">

      @if ($errors->any())
        <div class="bg-[#FBEAE4] border border-[#E3AE9A] text-[#8A3F26] text-sm rounded-xl p-4 mb-6">
          <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('vendor.register.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Section: Account --}}
        <div>
          <p class="text-[11px] tracking-[0.2em] uppercase text-[#C89B3C] font-bold mb-1">Step 1</p>
          <h2 class="text-lg font-bold text-[#1B3B2F] mb-4">Your account</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <x-input-label for="name" value="Your Full Name" class="text-[#1B3B2F]" />
              <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('name')" required autofocus data-live="name" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="name"></p>
              <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div>
              <x-input-label for="email" value="Email" class="text-[#1B3B2F]" />
              <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('email')" required data-live="email" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="email"></p>
              <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <div>
              <x-input-label for="password" value="Password" class="text-[#1B3B2F]" />
              <x-text-input id="password" name="password" type="password" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required data-live="password" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="password"></p>
              <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <div>
              <x-input-label for="password_confirmation" value="Confirm Password" class="text-[#1B3B2F]" />
              <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required data-live="password_confirmation" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="password_confirmation"></p>
            </div>
          </div>
        </div>

        {{-- Section: Business --}}
        <div>
          <p class="text-[11px] tracking-[0.2em] uppercase text-[#C89B3C] font-bold mb-1">Step 2</p>
          <h2 class="text-lg font-bold text-[#1B3B2F] mb-4">Your business</h2>
          <div class="space-y-4">
            <div>
              <x-input-label for="business_name" value="Shop / Business Name" class="text-[#1B3B2F]" />
              <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('business_name')" required data-live="business_name" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="business_name"></p>
              <x-input-error :messages="$errors->get('business_name')" class="mt-1" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <x-input-label for="business_phone" value="Business Phone" class="text-[#1B3B2F]" />
                <x-text-input id="business_phone" name="business_phone" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('business_phone')" required data-live="business_phone" />
                <p class="field-hint text-xs mt-1 hidden" data-hint-for="business_phone"></p>
                <x-input-error :messages="$errors->get('business_phone')" class="mt-1" />
              </div>
              <div>
                <x-input-label for="business_address" value="Business Address" class="text-[#1B3B2F]" />
                <x-text-input id="business_address" name="business_address" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('business_address')" required data-live="business_address" />
                <p class="field-hint text-xs mt-1 hidden" data-hint-for="business_address"></p>
                <x-input-error :messages="$errors->get('business_address')" class="mt-1" />
              </div>
            </div>
          </div>
        </div>

        {{-- Section: PAN Verification --}}
        <div>
          <h2 class="text-sm font-bold text-[#1B3B2F] mb-1">PAN verification</h2>
          <p class="text-xs text-[#8A9088] mb-3">Required for tax and business identity verification.</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
            <div>
              <x-input-label for="pan_number" value="PAN Number" class="text-[#1B3B2F]" />
              <x-text-input id="pan_number" name="pan_number" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('pan_number')" placeholder="e.g. 123456789" required data-live="pan_number" />
              <p class="field-hint text-xs mt-1 hidden" data-hint-for="pan_number"></p>
              <x-input-error :messages="$errors->get('pan_number')" class="mt-1" />
            </div>
            <div>
              <x-input-label for="pan_document" value="PAN Certificate (photo or PDF)" class="text-[#1B3B2F]" />
              <label for="pan_document" class="mt-1 flex items-center gap-2 border border-dashed border-[#C7D2C0] rounded-lg px-3 py-2 cursor-pointer hover:border-[#2F6B4F] hover:bg-[#F7F3E8] transition">
                <span class="text-lg">📄</span>
                <span id="pan-file-label" class="text-sm text-[#8A9088]">Click to upload PAN document</span>
              </label>
              <input id="pan_document" type="file" name="pan_document" accept="image/*,.pdf" required class="hidden">
              <x-input-error :messages="$errors->get('pan_document')" class="mt-1" />
            </div>
          </div>
        </div>

        {{-- Section: Bank --}}
        <div>
          <h2 class="text-sm font-bold text-[#1B3B2F] mb-1">Bank details</h2>
          <p class="text-xs text-[#8A9088] mb-3">For payouts — optional now, add later from your dashboard.</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <x-input-label for="bank_name" value="Bank Name" class="text-[#1B3B2F]" />
              <x-text-input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('bank_name')" />
            </div>
            <div>
              <x-input-label for="bank_account_no" value="Account Number" class="text-[#1B3B2F]" />
              <x-text-input id="bank_account_no" name="bank_account_no" type="text" class="mt-1 block w-full rounded-lg border-[#C7D2C0] focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" :value="old('bank_account_no')" />
            </div>
          </div>
        </div>

        {{-- Section: Photos --}}
        <div>
          <p class="text-[11px] tracking-[0.2em] uppercase text-[#C89B3C] font-bold mb-1">Step 3</p>
          <h2 class="text-lg font-bold text-[#1B3B2F] mb-1">Sample product photos</h2>
          <p class="text-xs text-[#8A9088] mb-3">Upload 1–5 photos of what you plan to sell — this is what we review first.</p>
          <label for="sample_photos" class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#C7D2C0] rounded-2xl py-8 cursor-pointer hover:border-[#2F6B4F] hover:bg-[#F7F3E8] transition">
            <span class="text-2xl">🌿</span>
            <span class="text-sm font-semibold text-[#2F6B4F]" id="upload-cta">Click to upload photos</span>
            <span class="text-xs text-[#8A9088]">JPG or PNG, up to 4MB each — select up to 5 at once, or add more later</span>
          </label>
          <input id="sample_photos" type="file" name="sample_photos[]" multiple accept="image/*" required class="hidden">
          <div id="photo-preview" class="flex gap-2 flex-wrap mt-3"></div>
          <x-input-error :messages="$errors->get('sample_photos')" class="mt-1" />
          <x-input-error :messages="$errors->get('sample_photos.*')" class="mt-1" />
        </div>

        {{-- Section: Agreement — styled as a torn ticket stub --}}
        <div>
          <p class="text-[11px] tracking-[0.2em] uppercase text-[#C89B3C] font-bold mb-1">Step 4</p>
          <h2 class="text-lg font-bold text-[#1B3B2F] mb-4">Vendor agreement</h2>

          <div class="relative border-2 border-dashed border-[#C7D2C0] rounded-2xl bg-[#FBFAF5]">
            <span class="absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-[#F7F3E8] border-2 border-dashed border-[#C7D2C0]"></span>
            <span class="absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-[#F7F3E8] border-2 border-dashed border-[#C7D2C0]"></span>

            <div class="p-5">
              <div class="text-xs text-[#5A6B5C] leading-relaxed h-28 overflow-y-auto pr-2 mb-4">
                By applying, you agree that Biruwa will list and sell your products on your behalf under a
                commission-based arrangement. Biruwa deducts an agreed commission percentage from each sale
                before payout. You are responsible for providing accurate product information and maintaining
                sufficient stock. Biruwa reserves the right to reject or suspend vendor accounts that violate
                quality standards, provide misleading information, or fail to fulfill orders. Payouts are
                processed periodically to the bank details provided. This agreement may be updated; continued
                use of your vendor account constitutes acceptance of updated terms.
              </div>
              <label class="flex items-start gap-2 text-sm text-[#1B3B2F] font-medium">
                <input type="checkbox" name="agreement" value="1" required class="mt-0.5 rounded border-[#C7D2C0] text-[#2F6B4F] focus:ring-[#2F6B4F]">
                I've read and agree to the Vendor Agreement above.
              </label>
            </div>
          </div>
        </div>

        <button type="submit"
                class="w-full bg-[#2F6B4F] hover:bg-[#1B3B2F] text-white font-bold py-3.5 rounded-xl transition-colors">
          Submit Application
        </button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('pan_document').addEventListener('change', function (e) {
    const label = document.getElementById('pan-file-label');
    label.textContent = e.target.files.length ? e.target.files[0].name : 'Click to upload PAN document';
    label.classList.toggle('text-[#2F6B4F]', e.target.files.length > 0);
    label.classList.toggle('font-semibold', e.target.files.length > 0);
  });

  (function () {
    const MAX_PHOTOS = 5;
    const input   = document.getElementById('sample_photos');
    const preview = document.getElementById('photo-preview');
    const cta     = document.getElementById('upload-cta');

    // Files picked so far, accumulated across multiple dialog opens —
    // a plain <input multiple> overwrites its FileList every time you
    // reopen the picker, so we keep our own running list instead.
    let selectedFiles = [];

    function syncInputFiles() {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      input.files = dataTransfer.files;
      cta.textContent = selectedFiles.length
        ? `${selectedFiles.length} of ${MAX_PHOTOS} photos selected — click to add more`
        : 'Click to upload photos';
    }

    function renderPreviews() {
      preview.innerHTML = '';
      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (ev) => {
          const wrap = document.createElement('div');
          wrap.className = 'relative w-16 h-16';
          wrap.innerHTML = `
            <img src="${ev.target.result}" class="w-16 h-16 object-cover rounded-lg border border-[#C7D2C0]">
            <button type="button" data-index="${index}"
                    class="remove-photo absolute -top-2 -right-2 w-5 h-5 bg-white border border-[#C7D2C0]
                           rounded-full text-xs text-[#8A3F26] font-bold flex items-center justify-center shadow">
              ×
            </button>`;
          preview.appendChild(wrap);

          wrap.querySelector('.remove-photo').addEventListener('click', () => {
            selectedFiles.splice(index, 1);
            syncInputFiles();
            renderPreviews();
          });
        };
        reader.readAsDataURL(file);
      });
    }

    input.addEventListener('click', () => {
      // Let the same input be reopened to ADD more, without losing what's picked
      input.value = '';
    });

    input.addEventListener('change', (e) => {
      const newFiles = [...e.target.files];
      let blocked = false;

      for (const file of newFiles) {
        if (selectedFiles.length >= MAX_PHOTOS) {
          blocked = true;
          break;
        }
        selectedFiles.push(file);
      }

      if (blocked) {
        Swal.fire({
          title: 'Photo limit reached 🌿',
          text: `You can only upload up to ${MAX_PHOTOS} sample photos.`,
          icon: 'warning',
          confirmButtonText: 'Got it',
          confirmButtonColor: '#2F6B4F',
          customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-xl px-6',
          }
        });
      }

      syncInputFiles();
      renderPreviews();
    });
  })();

  // ── Live inline validation ─────────────────────────────────────
  // Gives instant feedback as the vendor fills the form, instead of
  // only showing problems after a full submit + page reload.
  (function () {
    const rules = {
      name: (v) => v.trim().length >= 3
        ? { ok: true }
        : { ok: false, msg: 'Full name must be at least 3 characters.' },

      email: (v) => /^[a-zA-Z0-9][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(v.trim())
        ? { ok: true }
        : { ok: false, msg: 'Enter a valid email, e.g. name123@gmail.com' },

      password: (v) => {
        if (v.length < 8) return { ok: false, msg: 'At least 8 characters.' };
        if (!/[a-z]/.test(v) || !/[A-Z]/.test(v)) return { ok: false, msg: 'Include both upper and lower case letters.' };
        if (!/[0-9]/.test(v)) return { ok: false, msg: 'Include at least one number.' };
        return { ok: true };
      },

      password_confirmation: (v) => {
        const pw = document.getElementById('password').value;
        return v === pw
          ? { ok: true }
          : { ok: false, msg: 'Passwords do not match.' };
      },

      business_name: (v) => v.trim().length >= 2
        ? { ok: true }
        : { ok: false, msg: 'Business name is required.' },

      business_phone: (v) => /^[0-9+\-\s()]{7,20}$/.test(v.trim())
        ? { ok: true }
        : { ok: false, msg: 'Enter a valid phone number.' },

      business_address: (v) => v.trim().length >= 5
        ? { ok: true }
        : { ok: false, msg: 'Please enter a fuller address.' },

      pan_number: (v) => /^[0-9]{9}$/.test(v.trim())
        ? { ok: true }
        : { ok: false, msg: 'PAN number should be 9 digits.' },
    };

    const okClasses  = ['border-[#2F6B4F]', 'ring-1', 'ring-[#2F6B4F]'];
    const badClasses = ['border-[#D9765A]', 'ring-1', 'ring-[#D9765A]'];

    function validateField(field) {
      const rule = rules[field.dataset.live];
      if (!rule) return;

      const hint = document.querySelector(`[data-hint-for="${field.dataset.live}"]`);
      const value = field.value;

      // Don't scold an empty required field until they've actually left it
      if (value.trim() === '') {
        field.classList.remove(...okClasses, ...badClasses);
        hint.classList.add('hidden');
        return;
      }

      const result = rule(value);
      field.classList.remove(...okClasses, ...badClasses);
      field.classList.add(...(result.ok ? okClasses : badClasses));

      if (result.ok) {
        hint.classList.add('hidden');
      } else {
        hint.textContent = result.msg;
        hint.classList.remove('hidden');
        hint.classList.remove('text-[#2F6B4F]');
        hint.classList.add('text-[#D9765A]');
      }
    }

    document.querySelectorAll('[data-live]').forEach((field) => {
      field.addEventListener('input', () => validateField(field));
      field.addEventListener('blur', () => validateField(field));
    });

    // Re-check confirm-password whenever password itself changes
    const pwField = document.getElementById('password');
    const pwConfirmField = document.getElementById('password_confirmation');
    if (pwField && pwConfirmField) {
      pwField.addEventListener('input', () => {
        if (pwConfirmField.value) validateField(pwConfirmField);
      });
    }
  })();

  // ── Live duplicate check (email / PAN number / business name) ──
  // Asks the server in real time while typing, so "already
  // registered / already used" shows immediately — no need to
  // submit the whole form first to find out.
  (function () {
    const CHECK_URL = @json(route('vendor.register.check'));
    const duplicateFields = ['email', 'pan_number', 'business_name'];
    const timers = {};

    function setDuplicateState(field, state, message) {
      const hint = document.querySelector(`[data-hint-for="${field.dataset.live}"]`);
      const okClasses  = ['border-[#2F6B4F]', 'ring-1', 'ring-[#2F6B4F]'];
      const badClasses = ['border-[#D9765A]', 'ring-1', 'ring-[#D9765A]'];

      if (state === 'checking') {
        hint.textContent = 'Checking availability…';
        hint.classList.remove('hidden', 'text-[#D9765A]');
        hint.classList.add('text-[#8A9088]');
        return;
      }

      if (state === 'taken') {
        field.classList.remove(...okClasses);
        field.classList.add(...badClasses);
        hint.textContent = message;
        hint.classList.remove('hidden', 'text-[#8A9088]');
        hint.classList.add('text-[#D9765A]');
        return;
      }

      if (state === 'available') {
        field.classList.remove(...badClasses);
        field.classList.add(...okClasses);
        hint.classList.add('hidden');
      }
    }

    duplicateFields.forEach((fieldName) => {
      const field = document.querySelector(`[data-live="${fieldName}"]`);
      if (!field) return;

      field.addEventListener('input', () => {
        const value = field.value.trim();
        clearTimeout(timers[fieldName]);

        if (value === '') return;

        setDuplicateState(field, 'checking');

        timers[fieldName] = setTimeout(() => {
          fetch(`${CHECK_URL}?field=${fieldName}&value=${encodeURIComponent(value)}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
          })
            .then((res) => res.json())
            .then((data) => {
              // Ignore stale responses if the field has changed since
              if (field.value.trim() !== value) return;

              if (data.status === 'taken') {
                setDuplicateState(field, 'taken', data.message);
              } else if (data.status === 'available') {
                setDuplicateState(field, 'available');
              }
            })
            .catch(() => { /* silent — server check is a nice-to-have, not blocking */ });
        }, 450); // debounce so we don't hit the server on every keystroke
      });
    });
  })();
</script>
@endsection