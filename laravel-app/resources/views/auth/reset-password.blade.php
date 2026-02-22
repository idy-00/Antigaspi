<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe | Anti-Gaspi SN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FDFCF0; }
        h1, h2 { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ url('/') }}" class="text-3xl font-bold text-[#2D5A41] tracking-tight text-decoration-none">
            ANTI-GASPI<span class="opacity-50 text-xl font-light">.SN</span>
        </a>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">Nouveau mot de passe</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white/80 backdrop-blur-sm py-10 px-6 shadow-2xl rounded-[2rem] sm:px-12 border border-white">
            
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <ul class="text-sm text-red-700 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="space-y-6" action="{{ route('password.store') }}" method="POST" x-data="{ showPassword: false, showConfirm: false }">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700">Adresse email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email', $request->email) }}"
                               class="appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700">Nouveau mot de passe</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required autocomplete="new-password"
                               class="appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium pr-12">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D5A41] focus:outline-none">
                            <svg x-show="!showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3.75 7.25c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M19.5 19.5l-15-15"/></svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700">Confirmer le mot de passe</label>
                    <div class="mt-1 relative">
                        <input id="password_confirmation" name="password_confirmation" :type="showConfirm ? 'text' : 'password'" required autocomplete="new-password"
                               class="appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium pr-12">
                        <button type="button" @click="showConfirm = !showConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D5A41] focus:outline-none">
                            <svg x-show="!showConfirm" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showConfirm" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3.75 7.25c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M19.5 19.5l-15-15"/></svg>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-lg shadow-orange-500/20 text-sm font-bold text-white bg-[#E8AA42] hover:bg-[#d99b35] transition-all transform hover:-translate-y-1">
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
