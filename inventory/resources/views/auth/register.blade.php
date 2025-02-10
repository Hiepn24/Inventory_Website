<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d1c4e9;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg flex w-full max-w-4xl">
        <div class="w-1/2 bg-white text-red-500 flex flex-col items-center justify-center">
            <div class="text-center w-full py-20">
                <h1 class="text-4xl font-bold">ĐĂNG</h1>
                <h1 class="text-4xl font-bold">KÝ</h1>
            </div>
            <div class="text-center bg-red-500 w-full py-20">
                <h1 class="text-4xl font-bold text-white">ĐĂNG</h1>
                <h1 class="text-4xl font-bold text-white">NHẬP</h1>
            </div>
        </div>
        <div class="w-1/2 p-8 bg-gray-100">
            <h1 class="text-3xl font-bold text-red-500 mb-8 text-center">ĐĂNG KÝ</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required 
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none @error('name') is-invalid @enderror" 
                            placeholder="Nhập tên">
                        <i class="fas fa-user text-gray-500"></i>
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none @error('email') is-invalid @enderror" 
                            placeholder="Nhập email">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <input id="password" type="password" name="password" required 
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none @error('password') is-invalid @enderror" 
                            placeholder="Nhập mật khẩu">
                        <i class="fas fa-lock text-gray-500"></i>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <input id="password-confirm" type="password" name="password_confirmation" required 
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" 
                            placeholder="Xác nhận lại mật khẩu">
                        <i class="fas fa-lock text-gray-500"></i>
                    </div>
                </div>
                <div class="flex items-center justify-center mb-4">
                    <button type="submit" class="bg-purple-500 text-white py-2 px-8 rounded-full hover:bg-purple-700">Tạo</button>
                </div>
                <div class="text-center">
                    <span class="text-gray-700">Đã có tài khoản? 
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-purple-500">Đăng nhập</a>
                        @endif
                    </span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
