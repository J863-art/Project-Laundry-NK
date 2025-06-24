<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pelanggan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    .scrollbar-thin::-webkit-scrollbar {
      width: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
      background: transparent;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
      background-color: #d1d5db;
      border-radius: 3px;
    }
  </style>
</head>
<body class="bg-[#fefcfb] min-h-screen font-sans">
  <div class="max-w-md mx-auto min-h-screen flex flex-col bg-[#fefcfb]">
    <!-- Header -->
    <header class="bg-[#d72e6a] flex items-center justify-between px-5 py-4">
      <h1 class="text-white font-extrabold text-lg leading-none">Pelanggan</h1>
      <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <!-- Content -->
    <main class="px-5 py-4 flex flex-col gap-3 flex-grow overflow-y-auto scrollbar-thin">
      <!-- Search input -->
      {{-- Form pencarian dan pengurutan --}}
  <form method="GET" action="{{ route('pelangganowner.index') }}" class="space-y-2">
    {{-- Input Pencarian --}}
    <input
      type="search"
      name="search"
      value="{{ request('search') }}"
      aria-label="Cari Pesanan"
      placeholder="Cari Pesanan"
      class="w-full border border-gray-300 rounded-md text-sm text-gray-700 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#DD2E6E] focus:border-[#DD2E6E]"
    />


  </form>

      <!-- List of customers -->
      <ul class="flex flex-col gap-3">
        @foreach($customers as $customer)
        <li>
          <div class="border border-gray-200 rounded-md p-3 flex flex-col gap-1">
            <div class="text-gray-800 text-sm font-normal">{{ $customer->full_name }}</div>
            <div class="text-gray-600 text-xs font-normal">{{ $customer->phone_number }}</div>
            <div class="flex justify-between items-center text-xs mt-1">
              <span class="text-[#d7a95a] font-semibold">{{ $customer->pesanan_count }}x Pesanan</span>
              <span class="text-gray-400 font-normal">{{ $customer->address ?? '-' }}</span>
            </div>
            <!-- Button Detail -->
            <div class="mt-2">
              <a
                href="{{ route('owner.pelanggan.detail', $customer->id) }}"
                class="text-blue-400 text-xs font-medium hover:underline"
                >
                Detail Pelanggan
                </a>

            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </main>
  </div>
</body>
</html>
