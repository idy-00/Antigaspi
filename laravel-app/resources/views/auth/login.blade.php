<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Anti-Gaspi SN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FDFCF0; }
        h1, h2 { font-family: 'Outfit', sans-serif; }
        
        .premium-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(45, 90, 65, 0.1);
        }
        
        .login-card {
            transition: all 0.4s ease;
        }
        .login-card:hover {
            box-shadow: 0 20px 40px -10px rgba(45, 90, 65, 0.08);
        }
    </style>
</head>
<body class="bg-[#FDFCF0] min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ url('/') }}" class="text-3xl font-bold text-[#2D5A41] tracking-tight text-decoration-none">
            ANTI-GASPI<span class="opacity-50 text-xl font-light">.SN</span>
        </a>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">Connexion Partenaire</h2>
        <p class="mt-2 text-sm text-gray-500">
            Ou <a href="{{ route('register') }}" class="font-bold text-[#E8AA42] hover:text-[#d99b35] transition decoration-2 underline-offset-4 hover:underline">créez un nouveau compte</a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white/80 backdrop-blur-sm py-10 px-6 shadow-2xl rounded-[2rem] sm:px-12 border border-white login-card">
            
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <ul class="text-sm text-red-700 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700">Adresse email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="premium-input appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium" 
                               placeholder="nom@commerce.sn">
                    </div>
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-bold text-gray-700">Mot de passe</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" required 
                               class="premium-input appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium pr-12" 
                               placeholder="••••••••">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D5A41] focus:outline-none">
                            <svg x-show="!showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3.75 7.25c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M19.5 19.5l-15-15"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-[#2D5A41] focus:ring-[#2D5A41] border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Se souvenir de moi</label>
                    </div>

                    @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-[#2D5A41] hover:text-[#E8AA42] transition">Mot de passe oublié ?</a>
                    </div>
                    @endif
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-lg shadow-orange-500/20 text-sm font-bold text-white bg-[#E8AA42] hover:bg-[#d99b35] hover:shadow-orange-500/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E8AA42] transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                        Se connecter au Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
