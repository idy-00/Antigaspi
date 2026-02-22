<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord | Anti-Gaspi SN</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- CSS Frameworks -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --forest: #2D5A41;
            --cream: #FDFCF0;
            --white-soft: #ffffff;
            --accent: #E8AA42;
        }

        body {
            background-color: var(--cream);
            font-family: 'Inter', sans-serif;
            color: #1F2937;
        }

        h1, h2, h3, h4 { font-family: 'Outfit', sans-serif; }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(45, 90, 65, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .glass-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 45px -10px rgba(45, 90, 65, 0.1);
            border-color: var(--accent);
        }

        .step-circle {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .step-card:hover .step-circle {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 0 0 8px rgba(232, 170, 66, 0.2);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#2D5A41] text-white py-4 px-6 md:px-12 flex justify-between items-center shadow-lg">
        <div class="flex items-center gap-3">
            <span class="font-bold text-2xl tracking-tight">ANTI-GASPI<span class="opacity-50 text-base font-light">.PARTNER</span></span>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden md:block">
                <p class="font-bold text-[#E8AA42]">{{ Auth::user()->nom_commerce }}</p>
                <p class="text-xs text-white/60">{{ Auth::user()->nom_gerant }}</p>
            </div>
            
            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white">
                @php
                    $type = Auth::user()->type_commerce;
                @endphp
                @if($type === 'boulangerie')
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                @elseif($type === 'restaurant')
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                @elseif($type === 'supermarche')
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                @elseif($type === 'hotel')
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                @else
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                @endif
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ml-4 text-sm text-white/60 hover:text-white transition">
                    Déconnexion
                </button>
            </form>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="relative pt-20 pb-32 px-6 overflow-hidden">
        <div class="container mx-auto max-w-6xl relative z-10">
            <!-- Stats Section -->


            <div class="md:w-2/3" data-aos="fade-right">
                @if(Auth::user()->is_verified)
                    <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-[#2D5A41] text-sm font-bold mb-4">
                        Compte Vérifié & Actif ✅
                    </span>
                @else
                    <span class="inline-block py-1 px-3 rounded-full bg-yellow-100 text-yellow-800 text-sm font-bold mb-4">
                        En attente de vérification ⏳
                    </span>
                @endif
                <h1 class="text-4xl md:text-6xl font-bold text-[#2D5A41] mb-6 leading-tight">
                    Bienvenue, <br>
                    <span class="text-[#E8AA42]">{{ Auth::user()->nom_commerce }}.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl leading-relaxed">
                    Félicitations ! Vous avez rejoint le mouvement. Voici un aperçu de la manière dont vous allez bientôt révolutionner la gestion de vos invendus grâce à notre application mobile dédiée.
                </p>
                
                <div class="flex gap-4">
                    <button class="bg-[#E8AA42] text-white px-8 py-4 rounded-xl font-bold shadow-lg shadow-orange-500/20 hover:scale-105 active:scale-95 transition duration-300">
                        Télécharger l'App (Bientôt)
                    </button>
                    <button class="border-2 border-[#2D5A41] text-[#2D5A41] px-8 py-4 rounded-xl font-bold hover:bg-[#2D5A41] hover:text-white transition duration-300">
                        Guide PDF
                    </button>
                </div>
            </div>
            
            <!-- Dashboard preview illustration -->
            <div class="absolute top-10 right-0 w-1/3 hidden lg:block" data-aos="fade-left" data-aos-delay="200">
                 <div class="relative w-64 h-[500px] bg-gray-900 rounded-[3rem] border-8 border-gray-900 shadow-2xl mx-auto overflow-hidden ring-1 ring-white/20">
                    <div class="absolute top-0 w-full h-8 bg-black z-20 rounded-b-xl"></div>
                    <div class="w-full h-full bg-white flex flex-col">
                        <div class="h-32 bg-[#2D5A41] p-6 flex flex-col justify-end">
                            <h3 class="text-white font-bold text-lg">Tableau de Bord</h3>
                            <p class="text-white/70 text-sm">Aujourd'hui</p>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="bg-orange-50 p-4 rounded-xl border border-orange-100">
                                <span class="text-xs font-bold text-orange-400 uppercase">Impact</span>
                                <div class="text-2xl font-bold text-gray-800">12 Paniers</div>
                                <div class="text-sm text-gray-500">Sauvés cette semaine</div>
                            </div>
                            <div class="h-24 bg-gray-100 rounded-xl animate-pulse"></div>
                            <div class="h-24 bg-gray-100 rounded-xl animate-pulse"></div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-100/50 rounded-full blur-3xl -z-10 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-orange-100/50 rounded-full blur-3xl -z-10 -translate-x-1/3 translate-y-1/3"></div>
    </header>

    <!-- Onboarding Steps -->
    <section class="py-20 bg-white">
        <div class="container mx-auto max-w-6xl px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2D5A41] mb-4">Votre voyage commence ici</h2>
                <p class="text-gray-500">Gérez votre boutique en toute simplicité depuis votre mobile.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="step-card group relative p-8 rounded-3xl bg-white border border-transparent hover:border-orange-100 hover:shadow-2xl transition duration-500" data-aos="fade-up">
                    <div class="step-circle w-16 h-16 bg-[#2D5A41] text-white rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-[#E8AA42] group-hover:rotate-12">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Créez vos Paniers</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Prenez une photo de vos invendus, fixez un prix réduit (min -50%) et indiquez la quantité disponible. C'est publié en 30 secondes.
                    </p>
                </div>
 
                <!-- Step 2 -->
                <div class="step-card group relative p-8 rounded-3xl bg-white border border-transparent hover:border-orange-100 hover:shadow-2xl transition duration-500" data-aos="fade-up" data-aos-delay="150">
                    <div class="step-circle w-16 h-16 bg-[#2D5A41] text-white rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-[#E8AA42] group-hover:rotate-12">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Les Clients Réservent</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Les utilisateurs autour de vous reçoivent une notification. Ils réservent et paient directement via l'application. Vous êtes notifié instantanément.
                    </p>
                </div>
 
                <!-- Step 3 -->
                <div class="step-card group relative p-8 rounded-3xl bg-white border border-transparent hover:border-orange-100 hover:shadow-2xl transition duration-500" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-circle w-16 h-16 bg-[#2D5A41] text-white rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-[#E8AA42] group-hover:rotate-12">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Retrait en Boutique</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Le client passe récupérer son panier à l'heure que VOUS avez définie. Vérifiez simplement son reçu sur son téléphone et le tour est joué.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1A2E24] text-white py-10 border-t border-white/10 mt-auto">
        <div class="container mx-auto text-center opacity-60 text-sm">
            <p>&copy; {{ date('Y') }} Anti-Gaspi SN. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>
