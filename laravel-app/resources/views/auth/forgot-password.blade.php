<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | Anti-Gaspi SN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FDFCF0; }
        h1, h2 { font-family: 'Outfit', sans-serif; }
        .premium-input { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .premium-input:focus { transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(45, 90, 65, 0.1); }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ url('/') }}" class="text-3xl font-bold text-[#2D5A41] tracking-tight text-decoration-none">
            ANTI-GASPI<span class="opacity-50 text-xl font-light">.SN</span>
        </a>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">Mot de passe oublié ?</h2>
        <p class="mt-2 text-sm text-gray-500">
            Entrez votre email pour réinitialiser votre compte.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white/80 backdrop-blur-sm py-10 px-6 shadow-2xl rounded-[2rem] sm:px-12 border border-white">
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <ul class="text-sm text-red-700 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700">Adresse email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="premium-input appearance-none block w-full px-4 py-4 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#2D5A41]/5 focus:border-[#2D5A41] sm:text-sm font-medium" 
                               placeholder="votre@email.com">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-lg shadow-orange-500/20 text-sm font-bold text-white bg-[#E8AA42] hover:bg-[#d99b35] hover:shadow-orange-500/30 transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                        Envoyer les instructions
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-[#2D5A41] hover:text-[#E8AA42] transition text-decoration-none">
                        Retour à la connexion
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
