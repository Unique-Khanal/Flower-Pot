@extends('layouts.vendor')
@section('title', 'Add Product')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-extrabold text-[#1B3B2F] mb-1">Add a Product</h1>
    <p class="text-sm text-stone-500 mb-6">New listings go live once an admin reviews them.</p>

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Product name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">{{ old('description') }}</textarea>
            @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Category</label>
                <select name="category" required class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                    <option value="">Select...</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
                @error('category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Size <span class="text-stone-400 font-normal">(if applicable)</span></label>
                <select name="size" class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                    <option value="">N/A</option>
                    <option value="small"  {{ old('size') === 'small'  ? 'selected' : '' }}>Small</option>
                    <option value="medium" {{ old('size') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="large"  {{ old('size') === 'large'  ? 'selected' : '' }}>Large</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Price (Rs.)</label>
                <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required
                       class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Stock</label>
                <input type="number" name="stock" min="0" value="{{ old('stock', 1) }}" required
                       class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                @error('stock') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Photos</label>
            <p class="text-xs text-stone-500 mb-2">Upload 1–5 photos. The first one becomes the main product photo.</p>

            <label for="images" class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-stone-300 rounded-2xl py-8 cursor-pointer hover:border-[#2F6B4F] hover:bg-[#F7F3E8] transition">
                <span class="text-2xl">🌿</span>
                <span class="text-sm font-semibold text-[#2F6B4F]" id="upload-cta">Click to upload photos</span>
                <span class="text-xs text-stone-400">JPG or PNG, up to 4MB each</span>
            </label>
            <input id="images" type="file" name="images[]" multiple accept="image/*" class="hidden">
            <div id="photo-preview" class="flex gap-2 flex-wrap mt-3"></div>
            @error('images') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            @error('images.*') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-5 py-2.5 rounded-xl">
                Submit for Review
            </button>
            <a href="{{ route('vendor.products.index') }}" class="text-sm text-stone-500 hover:text-stone-700 font-medium px-3 py-2.5">
                Cancel
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(function () {
    const MAX_PHOTOS = {{ \App\Http\Controllers\Vendor\ProductController::MAX_IMAGES }};
    const input   = document.getElementById('images');
    const preview = document.getElementById('photo-preview');
    const cta     = document.getElementById('upload-cta');

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
                    <img src="${ev.target.result}" class="w-16 h-16 object-cover rounded-lg border border-stone-200">
                    ${index === 0 ? '<span class="absolute bottom-0 left-0 right-0 bg-[#1B3B2F] text-white text-[8px] font-bold text-center rounded-b-lg">MAIN</span>' : ''}
                    <button type="button" data-index="${index}"
                            class="remove-photo absolute -top-2 -right-2 w-5 h-5 bg-white border border-stone-200
                                   rounded-full text-xs text-red-600 font-bold flex items-center justify-center shadow">
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

    input.addEventListener('click', () => { input.value = ''; });

    input.addEventListener('change', (e) => {
        const newFiles = [...e.target.files];
        let blocked = false;

        for (const file of newFiles) {
            if (selectedFiles.length >= MAX_PHOTOS) { blocked = true; break; }
            selectedFiles.push(file);
        }

        if (blocked) {
            Swal.fire({
                title: 'Photo limit reached 🌿',
                text: `You can only upload up to ${MAX_PHOTOS} photos.`,
                icon: 'warning',
                confirmButtonText: 'Got it',
                confirmButtonColor: '#2F6B4F',
                customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
            });
        }

        syncInputFiles();
        renderPreviews();
    });
})();
</script>
@endsection