<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transaksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white">
  <div class="max-w-4xl mx-auto min-h-screen flex flex-col">
    <header class="bg-[#D92E6A] flex items-center justify-between px-8 py-4">
      <h1 class="text-white font-extrabold text-lg leading-none">Transaksi</h1>
      <button aria-label="Menu" class="text-white text-2xl leading-none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <main class="flex-grow px-8 py-6">
      <form class="mb-8">
        <input
          type="search"
          placeholder="Cari Transaksi/Nama Pelanggan"
          class="w-full border border-gray-300 rounded-md py-3 px-4 text-base placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#D92E6A]"
        />
      </form>

      <section class="space-y-8">
        <!-- Card 1 -->
        <article class="border border-gray-200 rounded-lg p-6">
          <div class="flex justify-between items-start mb-4">
            <h2 class="text-[#D92E6A] font-extrabold text-base leading-none">
              Pesanan #ORD- 3004
            </h2>
            <time class="text-sm text-gray-600">30 April 2025 16:00</time>
          </div>
          <div class="flex items-center space-x-4 mb-1">
            <i class="fas fa-user text-gray-600 text-lg"></i>
            <div>
              <p class="text-base font-normal text-gray-900 leading-tight">Siti Aminah</p>
              <p class="text-sm text-gray-500 leading-tight">0822-6576-9856</p>
            </div>
          </div>
          <p class="text-[#3CB371] text-base font-semibold mb-3 ml-auto w-fit">Rp40.000</p>
          <div class="flex items-center space-x-4">
            <button
              class="bg-[#E03E2F] text-white text-sm font-semibold rounded px-4 py-1 ml-auto"
              type="button"
            >
              Belum Lunas
            </button>
          </div>
          <div class="flex items-center space-x-4 mt-6">
            <i class="fas fa-calendar-alt text-gray-600 text-lg"></i>
            <p class="text-base font-normal text-gray-900 leading-tight">Estimasi Selesai</p>
            <time class="ml-auto text-sm text-gray-600">04 Mei 2025 16:00</time>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="border border-gray-200 rounded-lg p-6">
          <div class="flex justify-between items-start mb-4">
            <h2 class="text-[#D92E6A] font-extrabold text-base leading-none">
              Pesanan #ORD- 3004
            </h2>
            <time class="text-sm text-gray-600">30 April 2025 16:00</time>
          </div>
          <div class="flex items-center space-x-4 mb-1">
            <i class="fas fa-user text-gray-600 text-lg"></i>
            <div>
              <p class="text-base font-normal text-gray-900 leading-tight">Siti Aminah</p>
              <p class="text-sm text-gray-500 leading-tight">0822-6576-9856</p>
            </div>
          </div>
          <p class="text-[#3CB371] text-base font-semibold mb-3 ml-auto w-fit">Rp40.000</p>
          <div class="flex items-center space-x-4">
            <button
              class="bg-[#3CB371] text-white text-sm font-semibold rounded px-4 py-1 ml-auto"
              type="button"
            >
              Lunas
            </button>
          </div>
          <div class="flex items-center space-x-4 mt-6">
            <i class="fas fa-calendar-alt text-gray-600 text-lg"></i>
            <p class="text-base font-normal text-gray-900 leading-tight">Estimasi Selesai</p>
            <time class="ml-auto text-sm text-gray-600">04 Mei 2025 16:00</time>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="border border-gray-200 rounded-lg p-6">
          <div class="flex justify-between items-start mb-4">
            <h2 class="text-[#D92E6A] font-extrabold text-base leading-none">
              Pesanan #ORD- 3004
            </h2>
            <time class="text-sm text-gray-600">30 April 2025 16:00</time>
          </div>
          <div class="flex items-center space-x-4 mb-1">
            <i class="fas fa-user text-gray-600 text-lg"></i>
            <div>
              <p class="text-base font-normal text-gray-900 leading-tight">Siti Aminah</p>
              <p class="text-sm text-gray-500 leading-tight">0822-6576-9856</p>
            </div>
          </div>
          <p class="text-[#3CB371] text-base font-semibold mb-3 ml-auto w-fit">Rp40.000</p>
          <div class="flex items-center space-x-4">
            <button
              class="bg-[#E03E2F] text-white text-sm font-semibold rounded px-4 py-1 ml-auto"
              type="button"
            >
              Belum Lunas
            </button>
          </div>
          <div class="flex items-center space-x-4 mt-6">
            <i class="fas fa-calendar-alt text-gray-600 text-lg"></i>
            <p class="text-base font-normal text-gray-900 leading-tight">Estimasi Selesai</p>
            <time class="ml-auto text-sm text-gray-600">04 Mei 2025 16:00</time>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="border border-gray-200 rounded-lg p-6">
          <div class="flex justify-between items-start mb-4">
            <h2 class="text-[#D92E6A] font-extrabold text-base leading-none">
              Pesanan #ORD- 3004
            </h2>
            <time class="text-sm text-gray-600">30 April 2025 16:00</time>
          </div>
          <div class="flex items-center space-x-4 mb-1">
            <i class="fas fa-user text-gray-600 text-lg"></i>
            <div>
              <p class="text-base font-normal text-gray-900 leading-tight">Siti Aminah</p>
              <p class="text-sm text-gray-500 leading-tight">0822-6576-9856</p>
            </div>
          </div>
          <p class="text-[#3CB371] text-base font-semibold mb-3 ml-auto w-fit">Rp40.000</p>
          <div class="flex items-center space-x-4">
            <button
              class="bg-[#3CB371] text-white text-sm font-semibold rounded px-4 py-1 ml-auto"
              type="button"
            >
              Lunas
            </button>
          </div>
          <div class="flex items-center space-x-4 mt-6">
            <i class="fas fa-calendar-alt text-gray-600 text-lg"></i>
            <p class="text-base font-normal text-gray-900 leading-tight">Estimasi Selesai</p>
            <time class="ml-auto text-sm text-gray-600">04 Mei 2025 16:00</time>
          </div>
        </article>
      </section>
    </main>
  </div>
</body>
</html>
