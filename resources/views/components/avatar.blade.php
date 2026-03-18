@props(['avatar' => 'M2', 'size' => 36])

@if($avatar === 'M2')
    <svg viewBox="0 0 100 100" width="{{ $size }}" height="{{ $size }}" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="48" fill="#166534"/>
        <path d="M22 40 Q22 16 50 16 Q78 16 78 40" fill="#1c1917"/>
        <rect x="22" y="37" width="56" height="7" rx="3" fill="#1c1917"/>
        <circle cx="50" cy="48" r="26" fill="#fde68a"/>
        <rect x="35" y="34" width="13" height="3" rx="1.5" fill="#1c1917"/>
        <rect x="52" y="34" width="13" height="3" rx="1.5" fill="#1c1917"/>
        <rect x="34" y="39" width="14" height="10" rx="5" fill="none" stroke="#1c1917" stroke-width="1.5"/>
        <rect x="52" y="39" width="14" height="10" rx="5" fill="none" stroke="#1c1917" stroke-width="1.5"/>
        <line x1="48" y1="44" x2="52" y2="44" stroke="#1c1917" stroke-width="1.5"/>
        <circle cx="41" cy="44" r="2" fill="#1e3a5f"/>
        <circle cx="59" cy="44" r="2" fill="#1e3a5f"/>
        <circle cx="41.8" cy="43.2" r="0.8" fill="white"/>
        <circle cx="59.8" cy="43.2" r="0.8" fill="white"/>
        <path d="M43 56 Q50 61 57 56" stroke="#1c1917" stroke-width="1.6" fill="none" stroke-linecap="round"/>
        <ellipse cx="24" cy="48" rx="4" ry="6" fill="#fde68a"/>
        <ellipse cx="76" cy="48" rx="4" ry="6" fill="#fde68a"/>
        <path d="M20 98 Q20 76 50 76 Q80 76 80 98" fill="#15803d"/>
        <path d="M44 76 L50 84 L56 76" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
    </svg>

@elseif($avatar === 'F5')
    <svg viewBox="0 0 100 100" width="{{ $size }}" height="{{ $size }}" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="48" fill="#b45309"/>
        <circle cx="50" cy="46" r="26" fill="#fde68a"/>
        <circle cx="28" cy="32" r="11" fill="#dc2626"/>
        <circle cx="38" cy="22" r="11" fill="#dc2626"/>
        <circle cx="50" cy="19" r="11" fill="#dc2626"/>
        <circle cx="62" cy="22" r="11" fill="#dc2626"/>
        <circle cx="72" cy="32" r="11" fill="#dc2626"/>
        <circle cx="24" cy="44" r="9" fill="#dc2626"/>
        <circle cx="76" cy="44" r="9" fill="#dc2626"/>
        <ellipse cx="24" cy="46" rx="3.5" ry="5" fill="#fde68a"/>
        <ellipse cx="76" cy="46" rx="3.5" ry="5" fill="#fde68a"/>
        <circle cx="24" cy="52" r="2.5" fill="#fbbf24"/>
        <circle cx="76" cy="52" r="2.5" fill="#fbbf24"/>
        <path d="M36 34 Q42 30 47 34" stroke="#92400e" stroke-width="1.8" fill="none" stroke-linecap="round"/>
        <path d="M53 34 Q58 30 64 34" stroke="#92400e" stroke-width="1.8" fill="none" stroke-linecap="round"/>
        <ellipse cx="42" cy="42" rx="4.5" ry="4" fill="white"/>
        <ellipse cx="58" cy="42" rx="4.5" ry="4" fill="white"/>
        <circle cx="42" cy="43" r="2.8" fill="#b45309"/>
        <circle cx="58" cy="43" r="2.8" fill="#b45309"/>
        <circle cx="43" cy="42" r="1" fill="white"/>
        <circle cx="59" cy="42" r="1" fill="white"/>
        <path d="M43 56 Q50 62 57 56" stroke="#e11d48" stroke-width="2.2" fill="none" stroke-linecap="round"/>
        <circle cx="37" cy="50" r="4" fill="#fca5a5" opacity="0.45"/>
        <circle cx="63" cy="50" r="4" fill="#fca5a5" opacity="0.45"/>
        <path d="M22 98 Q22 76 50 76 Q78 76 78 98" fill="#b45309"/>
    </svg>

@else
    {{-- fallback default avatar if value is missing --}}
    <svg viewBox="0 0 100 100" width="{{ $size }}" height="{{ $size }}" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="48" fill="#166534"/>
        <circle cx="50" cy="40" r="20" fill="#fde68a"/>
        <path d="M20 98 Q20 70 50 70 Q80 70 80 98" fill="#15803d"/>
    </svg>
@endif