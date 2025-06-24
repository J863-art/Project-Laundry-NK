<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>NK Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-[#f9d9d9] min-h-screen flex flex-col items-center justify-center gap-8 p-4">
    <div class="flex flex-col items-center gap-1">
        <img src="{{ asset('images/download.png') }}" alt="Logo NK Laundry" width="120" height="120" class="object-contain"/>
      </div>


  <!-- Tombol Login Pemilik -->
  <a href="{{ route('login.owner') }}"
     class="flex items-center gap-4 bg-[#d6336c] text-white font-semibold text-lg rounded-md px-8 py-4 w-72 max-w-full">
    <i class="fas fa-user-circle text-3xl"></i>
    Pemilik
  </a>

  <!-- Tombol Login Kasir -->
  <a href="{{ route('login.kasir') }}"
     class="flex items-center gap-4 bg-[#d6336c] text-white font-semibold text-lg rounded-md px-8 py-4 w-72 max-w-full">
    <i class="fas fa-id-card-alt text-2xl"></i>
    Kasir
  </a>
</body>
</html>
