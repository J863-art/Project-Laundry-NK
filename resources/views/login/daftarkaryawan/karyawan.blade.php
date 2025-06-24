<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Karyawan</title>

    {{-- Tailwind & ikon --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet"/>
    <style>body{font-family:'Poppins',sans-serif}</style>
</head>
<body class="bg-white min-h-screen">

<header class="bg-[#d83973] px-6 py-4 flex justify-between items-center">
    <h1 class="text-white font-semibold text-lg">Karyawan</h1>
    <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>
</header>

<main class="px-6 py-6 max-w-md mx-auto">
    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-4 text-sm text-green-800 bg-green-100 py-2 px-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form pencarian --}}
    <form method="GET" class="mb-4">
        <label class="sr-only" for="search">Cari nama karyawan</label>
        <input id="search" name="search" value="{{ $search }}"
               class="w-full border border-gray-300 rounded-md py-2 px-3 text-gray-700 placeholder-gray-500
                      focus:outline-none focus:ring-2 focus:ring-[#d83973]"
               placeholder="Cari nama karyawan" type="search"/>
    </form>

    {{-- Tombol tambah --}}
    <a href="{{ route('karyawan.create') }}"
       class="mb-6 inline-block bg-[#d83973] text-white text-sm rounded-md px-4 py-2">
        Tambah Karyawan
    </a>

    {{-- Daftar karyawan --}}
    <ul class="space-y-3">
        @forelse($users as $user)
            <li>
                <div class="flex items-center justify-between border border-gray-300 rounded-md p-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $user->foto ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                             alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-gray-900 text-sm font-normal">Nama   :{{ $user->name }}</p>
                            <p class="text-gray-900 text-sm font-normal">Username : {{ $user->username }}</p>
                            <p class="text-gray-900 text-sm font-normal">Email : {{ $user->email }}</p>
                            <p class="text-gray-600 text-xs">No Telepon : {{ $user->no_telp ?? '-' }}</p>
                            <p class="text-gray-500 text-xs capitalize">Role : {{ $user->role }}</p>
                        </div>
                    </div>

                    {{-- Tombol ⋮ + dropdown --}}
                    <div class="relative">
                        <button type="button" onclick="toggleMenu(this)"
                                aria-label="More options"
                                class="text-gray-700 text-xl focus:outline-none">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>

                        <div class="menu-karyawan absolute right-0 top-full mt-1 w-36 bg-white border border-gray-300
                                    rounded-md shadow-md text-sm text-gray-900 hidden z-20">
                            {{-- Opsi EDIT --}}
                            <a href="{{ route('karyawan.edit', $user) }}"
                               class="block px-4 py-2 hover:bg-gray-100">
                                Edit Karyawan
                            </a>

                            {{-- Opsi HAPUS --}}
                            <form method="POST" action="{{ route('karyawan.destroy', $user) }}">
                                @csrf @method('DELETE')
                                <button class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                        type="submit"
                                        onclick="return confirm('Hapus karyawan {{ $user->name }}?')">
                                    Hapus Karyawan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="text-center text-sm text-gray-500">Belum ada data karyawan.</li>
        @endforelse
    </ul>
</main>

{{-- ========== JS untuk dropdown ========== --}}
<script>
    // Buka/tutup dropdown milik tombol yang diklik
    function toggleMenu(btn) {
        const menu = btn.nextElementSibling;        // div.menu-karyawan setelah tombol
        // Tutup dropdown lain lebih dulu
        document.querySelectorAll('.menu-karyawan').forEach(el => {
            if (el !== menu) el.classList.add('hidden');
        });
        // Toggle dropdown milik tombol sekarang
        menu.classList.toggle('hidden');
    }

    // Tutup dropdown jika klik di luar tombol/dropdown
    document.addEventListener('click', function (e) {
        const clickedButton = e.target.closest('[onclick="toggleMenu(this)"]');
        const clickedMenu   = e.target.closest('.menu-karyawan');
        if (!clickedButton && !clickedMenu) {
            document.querySelectorAll('.menu-karyawan').forEach(el => el.classList.add('hidden'));
        }
    });
</script>

</body>
</html>
