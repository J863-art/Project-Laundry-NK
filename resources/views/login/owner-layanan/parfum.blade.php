<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Layanan Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex justify-center items-start p-4">
  <div class="w-full max-w-md rounded-md overflow-hidden shadow-sm border border-gray-200">
    <header class="bg-[#d92f6a] flex justify-between items-center px-5 py-4">
      <h1 class="text-white font-extrabold text-lg leading-none">Layanan</h1>
      <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <div class="relative">
      <img src="https://debutart-static-v1.s3.eu-west-1.amazonaws.com/projectitem/5/9/d6bc3abfece589e23de0ea6066bd7573/13095_medium-retina.jpg?2016-04-0413%3A12%3A36="
           alt="Laundry Image"
           class="w-full object-cover"
           width="600"
           height="200"/>
      <h2 class="absolute bottom-3 left-3 text-white font-extrabold text-lg drop-shadow-md">
        Varian Parfum
      </h2>
    </div>

    <main class="p-5 space-y-3 bg-white">
      <ul class="space-y-3">
        @forelse ($parfums as $parfum)
          <li>
            <div class="flex justify-between items-center border border-gray-300 rounded-md px-3 py-2">
              <span class="italic font-semibold text-gray-800">{{ $parfum->nama_parfum }}</span>
              <div class="flex items-center space-x-3 text-gray-800 text-sm">
                <span>{{ $parfum->deskripsi }}</span>
                <a href="{{ route('parfum.edit', $parfum->id) }}" class="text-gray-700 hover:text-gray-900 focus:outline-none" aria-label="Edit {{ $parfum->nama_parfum }}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <form action="{{ route('parfum.destroy', $parfum->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-pink-600 hover:text-pink-700 focus:outline-none" aria-label="Delete {{ $parfum->nama_parfum }}">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </div>
          </li>
        @empty
          <li class="text-gray-500 italic text-sm text-center">Belum ada parfum tersedia.</li>
        @endforelse
      </ul>

      <div class="flex justify-center mt-6">
        <a href="{{ route('parfum.create') }}"
           class="bg-[#d92f6a] text-white font-semibold italic text-sm rounded-md px-6 py-2 focus:outline-none hover:bg-[#c1275f] inline-block text-center">
          Tambah Layanan
        </a>
      </div>
    </main>
  </div>
</body>
</html>
