<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INVENTORY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- In pdf --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    {{-- Icon --}}
    <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Web Awesome"
      href="/css/app-wa-9a26f71a0382097754e89a94b43cf564.css?vsn=d"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css"
    >
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css"
    >
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <div class="w-1/5 bg-white h-screen p-5 border-r border-gray-200 fixed">
            <div class="text-center mb-6">
                <div class="w-28 h-28 bg-gray-200 rounded-full flex items-center justify-center mx-auto mt-2">
                    <i class="fa-solid fa-user-tie-hair text-4xl text-blue-700"></i>
                </div>
                <p class="mt-2">
                    @auth
                    <i class="fa-regular fa-hand-wave"></i> Xin chào {{ Auth::user()->name }}
                    @endauth
                </p>
            </div>
            <nav>
                <a href="{{ route('home')}}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('home') ? 'font-bold' : '' }}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="{{ route('suppliers.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('suppliers.*') ? 'font-bold' : '' }}"> <i class="fa-duotone fa-light fa-address-card"></i> Nhà cung cấp</a>
                <a href="{{ route('customers.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('customers.*') ? 'font-bold' : '' }}"> <i class="fa-duotone fa-regular fa-users"></i> Khách hàng</a>
                <a href="{{ route('categories.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('categories.*') ? 'font-bold' : '' }}"> <i class="fa-sharp fa-regular fa-list"></i> Danh mục</a>
                <a href="{{ route('products.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('products.*') ? 'font-bold' : '' }}"> <i class="fa-solid fa-shirt"></i> Sản phẩm</a>
                <a href="{{ route('units.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('units.*') ? 'font-bold' : '' }}"> <i class="fa-brands fa-uniregistry"></i> Đơn vị</a>
                <a href="{{ route('purchases.index') }}" class="block py-2 px-4 text-gray-700 {{ request()->routeIs('purchases.*') ? 'font-bold' : '' }}"> <i class="fa-duotone fa-regular fa-cart-shopping"></i> Mua hàng</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block py-2 px-4 text-gray-700 mt-auto">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </button>
                </form>
            </nav>
        </div>
        <div class="w-4/5 p-5 ml-auto">
            @yield('content')
            @yield('scripts') 
        </div>
    </div>
</body>
</html>