<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Karyawan Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
    <style>body{font-family:'Poppins',sans-serif}</style>
</head>
<body class="bg-[#fef9f9] min-h-screen flex justify-center items-start p-4">
<div class="w-full max-w-xs bg-white shadow-md rounded-md">
    <header class="bg-[#d8396a] flex justify-between items-center px-6 py-4 rounded-t-md">
        <h1 class="text-white font-extrabold text-xl">Karyawan</h1>
        <button aria-label="Menu" class="text-white text-3xl leading-none focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    {{-- FORM --}}
    <form class="p-6 space-y-4" action="{{ route('karyawan.store') }}" method="POST">
        @csrf

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm mb-1">Nama Karyawan</label>
            <input id="name" name="name" type="text" placeholder="Nama"
                   value="{{ old('name') }}"
                   class="w-full border @error('name') border-red-500 @else border-gray-300 @enderror
                          rounded-md px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- No HP --}}
        <div>
            <label for="no_telp" class="block text-sm mb-1">No Handphone</label>
            <input id="no_telp" name="no_telp" type="text" placeholder="+62"
                   value="{{ old('no_telp') }}"
                   class="w-full border @error('no_telp') border-red-500 @else border-gray-300 @enderror
                          rounded-md px-4 py-2 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
            @error('no_telp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Username --}}
        <div>
            <label for="username" class="block text-sm mb-1">Username</label>
            <input id="username" name="username" type="text" placeholder="user_123"
                value="{{ old('username') }}"
                class="w-full border @error('username') border-red-500 @else border-gray-300 @enderror
                        rounded-md px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
            @error('username') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>


        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input id="email" name="email" type="email" placeholder="@gmail.com"
                   value="{{ old('email') }}"
                   class="w-full border @error('email') border-red-500 @else border-gray-300 @enderror
                          rounded-md px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm mb-1">Password</label>
            <div class="relative">
                <input id="password" name="password" type="password" placeholder="password"
                       class="w-full border @error('password') border-red-500 @else border-gray-300 @enderror
                              rounded-md px-4 py-2 pr-10 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
                <button type="button" aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600 focus:outline-none"
                        onclick="togglePassword('password', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="konfirm"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 pr-10 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#d8396a]"/>
                <button type="button" aria-label="Toggle confirm password visibility"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600 focus:outline-none"
                        onclick="togglePassword('password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        {{-- ROLE --}}
        <div>
            <label for="role" class="block text-sm mb-1">Role</label>
            <select id="role" name="role"
                    class="w-full border @error('role') border-red-500 @else border-gray-300 @enderror
                           rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#d8396a]">
                <option value="kasir"   {{ old('role', 'kasir')   == 'kasir'   ? 'selected' : '' }}>Kasir</option>
                <option value="pemilik" {{ old('role')            == 'pemilik' ? 'selected' : '' }}>Owner</option>
            </select>
            @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Gender (tetap kosmetik) --}}
        <fieldset>
            <legend class="text-sm mb-2 font-normal">Jenis Kelamin</legend>
            <div class="flex items-center space-x-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="radio" name="gender" value="laki" class="form-radio text-[#d8396a]">
                    <span class="text-sm">Laki - laki</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="radio" name="gender" value="perempuan" checked class="form-radio text-[#d8396a]">
                    <span class="text-sm">Perempuan</span>
                </label>
            </div>
        </fieldset>

        {{-- Tombol Simpan --}}
        <button type="submit"
                class="w-full bg-[#d8396a] text-white font-semibold rounded-full py-3 mt-4 hover:bg-[#c22f5a] transition-colors">
            Simpan
        </button>
    </form>
</div>

<script>
function togglePassword(id, btn){
    const input=document.getElementById(id);
    const icon=btn.querySelector('i');
    if(input.type==='password'){
        input.type='text'; icon.classList.replace('fa-eye','fa-eye-slash');
    }else{
        input.type='password'; icon.classList.replace('fa-eye-slash','fa-eye');
    }
}
</script>
</body>
</html>
