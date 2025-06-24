<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Layanan Laundry
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Poppins", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white min-h-screen">
  <header class="bg-[#d6336c] flex justify-between items-center px-5 py-4">
   <h1 class="text-white font-extrabold text-2xl">
    Layanan
   </h1>
   <button aria-label="Menu" class="text-white text-3xl font-extrabold leading-none">
    <i class="fas fa-bars">
    </i>
   </button>
  </header>
  <main class="px-5 pt-4">
   <p class="text-gray-900 text-base mb-3 max-w-md">
    Kelola semua layanan laundry yang tersedia untuk pelanggan anda
   </p>
   <form class="mb-5">
    <label class="sr-only" for="search">
     Cari layanan
    </label>
    <div class="relative text-gray-500">
     <input class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#d6336c] focus:border-transparent" id="search" placeholder="Cari layanan..." type="search"/>
     <svg aria-hidden="true" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24">
      <circle cx="11" cy="11" r="7">
      </circle>
      <line x1="21" x2="16.65" y1="21" y2="16.65">
      </line>
     </svg>
    </div>
   </form>
   <section class="grid grid-cols-2 gap-3 max-w-md">
    <article class="relative rounded-lg overflow-hidden">
     <img alt="Laundry machine door open with hands putting clothes inside" class="w-full h-36 object-cover" height="150" src="https://storage.googleapis.com/a1aa/image/87609d6c-4b82-4a9d-1aaa-e6e7b6ded3fe.jpg" width="300"/>
     <div class="absolute inset-0 bg-[#d6336c]/70 p-3 flex flex-col justify-between rounded-lg">
      <div>
       <p class="text-white italic font-semibold text-sm leading-tight">
        <span class="font-extrabold">
         Laundry Satuan
        </span>
       </p>
       <p class="text-white text-xs mt-1">
        Mulai dari Rp5.000
       </p>
      </div>
      <!-- Laundry Satuan -->
        <a href="{{ route('layanan.satuan') }}" class="bg-white text-[#d6336c] text-xs rounded-full px-5 py-1 self-start font-normal">
        Detail
        </a>
     </div>

    </article>
    <article class="relative rounded-lg overflow-hidden">
     <img alt="Laundry machines with basket full of clothes in front" class="w-full h-36 object-cover" height="150" src="https://storage.googleapis.com/a1aa/image/9e624455-4ea9-4b98-f43c-46cd9ceb2b78.jpg" width="300"/>
     <div class="absolute inset-0 bg-[#d6336c]/70 p-3 flex flex-col justify-between rounded-lg">
      <div>
       <p class="text-white italic font-semibold text-sm leading-tight">
        <span class="font-extrabold">
         Laundry Kiloan
        </span>
       </p>
       <p class="text-white text-xs mt-1">
        Mulai dari Rp4.000
       </p>
      </div>
      <!-- Laundry Kiloan -->
        <a href="{{ route('layanan.kiloan') }}" class="bg-white text-[#d6336c] text-xs rounded-full px-5 py-1 self-start font-normal">
        Detail
        </a>
     </div>


    </article>
    <article class="relative rounded-lg overflow-hidden">
     <img alt="Person loading laundry into washing machine, blankets and towels" class="w-full h-36 object-cover" height="150" src="https://storage.googleapis.com/a1aa/image/173965b1-d137-48ae-3e2f-550c822e3c4d.jpg" width="300"/>
     <div class="absolute inset-0 bg-[#d6336c]/70 p-3 flex flex-col justify-between rounded-lg">
      <div>
       <p class="text-white italic font-semibold text-sm leading-tight">
        <span class="font-extrabold">
         Laundry BedCover/Selimut/
         <br/>
         sprei/Handuk/Boneka
        </span>
       </p>
       <p class="text-white text-xs mt-1">
        Mulai dari Rp5.000
       </p>
      </div>
      <!-- BedCover/Selimut/... -->
        <a href="{{ route('layanan.lainnya') }}" class="bg-white text-[#d6336c] text-xs rounded-full px-5 py-1 self-start font-normal">
        Detail
        </a>
     </div>

    </article>
    <article class="relative rounded-lg overflow-hidden">
     <img alt="Person putting shoes into washing machine" class="w-full h-36 object-cover" height="150" src="https://storage.googleapis.com/a1aa/image/67b67327-b0bd-4c00-bd6b-8cd9231778cf.jpg" width="300"/>
     <div class="absolute inset-0 bg-[#d6336c]/70 p-3 flex flex-col justify-between rounded-lg">
      <div>
       <p class="text-white italic font-semibold text-sm leading-tight">
        <span class="font-extrabold">
         Cuci Sepatu
        </span>
       </p>
       <p class="text-white text-xs mt-1">
        Mulai dari Rp4.000
       </p>
      </div>
      <!-- Cuci Sepatu -->
        <a href="{{ route('layanan.sepatu') }}" class="bg-white text-[#d6336c] text-xs rounded-full px-5 py-1 self-start font-normal">
        Detail
        </a>
     </div>
    </article>

    <article class="relative rounded-lg overflow-hidden">
     <img alt="Person putting shoes into washing machine" class="w-full h-36 object-cover" height="150" src="https://debutart-static-v1.s3.eu-west-1.amazonaws.com/projectitem/5/9/d6bc3abfece589e23de0ea6066bd7573/13095_medium-retina.jpg?2016-04-0413%3A12%3A36=" width="300"/>
     <div class="absolute inset-0 bg-[#d6336c]/70 p-3 flex flex-col justify-between rounded-lg">
      <div>
       <p class="text-white italic font-semibold text-sm leading-tight">
        <span class="font-extrabold">
         Varian Parfum
        </span>
       </p>
       <p class="text-white text-xs mt-1">

       </p>
      </div>
      <!-- Cuci Sepatu -->
        <a href="{{ route('layanan.parfum') }}" class="bg-white text-[#d6336c] text-xs rounded-full px-5 py-1 self-start font-normal">
        Detail
        </a>
     </div>
    </article>
   </section>
  </main>
 </body>
</html>
