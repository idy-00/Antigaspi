<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Partenaire | ANTI-GASPI.SN</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --forest: #2D5A41;
            --cream: #FDFCF0;
            --accent: #E8AA42;
        }
        
        body { font-family: 'Inter', sans-serif; background-color: var(--cream); color: #1F2937; }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        
        .split-layout { min-height: 100vh; display: flex; position: relative; }
        .image-side { 
            flex: 1; 
            background-color: var(--forest);
            background-image: linear-gradient(135deg, rgba(45, 90, 65, 0.95), rgba(30, 60, 45, 0.9));
            background-size: cover;
            background-position: center; 
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 10;
        }
        
        .image-overlay { position: absolute; inset: 0; padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
        .form-side { flex: 1.2; display: flex; flex-direction: column; justify-content: center; padding: 4rem; background: var(--cream); min-height: 100vh; position: relative; }
        
        .form-input-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-input-container:focus-within {
            transform: translateX(10px);
        }

        @media (max-width: 1024px) { 
            .split-layout { flex-direction: column; } 
            .image-side { 
                position: relative;
                height: auto; 
                min-height: 300px;
                max-height: 400px; 
            } 
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>

    <div class="split-layout">
        <!-- Decoration Side -->
        <div class="image-side">
            <div class="image-overlay">
                <a href="{{ url('/') }}" class="text-white/80 hover:text-white mb-auto flex items-center gap-2 font-medium transition-colors text-decoration-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour à l'accueil
                </a>
                
                <div class="space-y-6">
                    <div class="w-16 h-16 bg-[#E8AA42] rounded-2xl flex items-center justify-center mb-6 text-white text-3xl shadow-lg shadow-orange-900/20">
                        🤝
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold text-[#FDFCF0] leading-tight">
                        Devenez <br><span class="text-[#E8AA42]">Partenaire.</span>
                    </h1>
                    <p class="text-gray-200 text-xl max-w-md leading-relaxed opacity-90">
                        Inscrivez votre commerce en 2 minutes. Valorisez vos invendus et attirez de nouveaux clients dakarois.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side" 
             x-data="onboardingForm()" 
             x-init="initMap()">

            <div class="max-w-xl mx-auto w-full">
                
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r shadow-sm flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <h3 class="text-red-800 font-bold">Oups ! Une erreur est survenue</h3>
                        <ul class="text-red-700 text-sm mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Progress Header -->
                <div class="mb-10">
                    <div class="flex items-center justify-between text-xs font-bold tracking-widest text-gray-400 uppercase mb-3">
                        <span :class="{'text-[#2D5A41]': step === 1}">1. Commerce</span>
                        <span :class="{'text-[#2D5A41]': step === 2}">2. Adresse</span>
                        <span :class="{'text-[#2D5A41]': step === 3}">3. Finalisation</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-[#2D5A41] transition-all duration-500 ease-out" 
                             :style="`width: ${(step / 3) * 100}%`"></div>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" @submit.prevent="validateAndSubmit($el)">
                    @csrf
                    
                    <!-- STEP 1: Identification -->
                    <div x-show="step === 1" 
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="space-y-8">
                        
                        <div>
                            <h2 class="text-3xl font-bold text-[#2D5A41] mb-2">Commençons par les bases</h2>
                            <p class="text-gray-500 text-lg">Quel type d'établissement gérez-vous ?</p>
                        </div>

                        <div class="relative z-[50] transition-all duration-200 form-input-container">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nom de l'établissement</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none transition-colors peer-focus:text-[#2D5A41]">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </span>
                                <input type="text" name="nom_commerce" x-model="formData.name" 
                                       @input.debounce.300ms="searchBoutique()"
                                       @focus="if(formData.name.length >= 3) searchBoutique()"
                                       autocomplete="off"
                                       class="peer w-full p-4 pl-12 border border-gray-200 rounded-xl bg-white/80 backdrop-blur outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-8 focus:ring-[#2D5A41]/5 focus:shadow-sm" 
                                       placeholder="Ex: Brioche Dorée, Auchan..." required>
                                
                                <!-- Search Suggestions -->
                                <div x-show="suggestions.length > 0" 
                                     @click.away="suggestions = []"
                                     class="absolute left-0 right-0 top-full mt-2 bg-white rounded-2xl shadow-2xl border border-gray-100 z-[1001] overflow-hidden" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-cloak>
                                    <div class="p-2 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-2">Établissements trouvés</span>
                                        <svg x-show="isSearching" class="animate-spin h-4 w-4 text-[#E8AA42] mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </div>
                                    <template x-for="item in suggestions" :key="item.place_id">
                                        <button type="button" @click="selectBoutique(item)" 
                                                class="w-full text-left p-4 hover:bg-[#2D5A41]/5 flex items-start gap-3 transition-colors group">
                                            <div class="mt-1 bg-gray-100 p-2 rounded-lg group-hover:bg-[#2D5A41] group-hover:text-white transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm text-gray-800" x-text="item.display_name.split(',')[0]"></div>
                                                <div class="text-[11px] text-gray-500 leading-tight mt-0.5" x-text="item.display_name"></div>
                                            </div>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 relative z-[10]">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em]">Secteur d'activité</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="type in types" :key="type.value">
                                    <label class="relative group cursor-pointer block">
                                        <input type="radio" name="type_commerce" :value="type.value" class="peer sr-only" x-model="formData.type" required>
                                        <div class="relative px-6 py-4 bg-white border border-gray-100 rounded-xl flex items-center justify-between transition-all duration-300 group-hover:border-gray-900 peer-checked:border-[#2D5A41] peer-checked:bg-[#2D5A41]/5 peer-checked:text-[#2D5A41]">
                                            <span class="text-sm font-semibold text-gray-900 font-outfit tracking-wide peer-checked:text-inherit transition-colors" x-text="type.label"></span>
                                            
                                            <div class="flex items-center gap-3">
                                                <!-- Simple Icons -->
                                                <div class="w-5 h-5 text-black peer-checked:text-inherit transition-all duration-300 group-hover:scale-110">
                                                    <template x-if="type.value === 'boulangerie'">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 16 3-3"/><path d="m19 16-3-3"/><path d="M2 13s2-2 4-2 4 2 6 2 4-2 6-2 4 2 4 2l-2 5H4l-2-5Z"/></svg>
                                                    </template>
                                                    <template x-if="type.value === 'restaurant'">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M18 6v6a6 6 0 0 1-12 0V6"/><path d="M11 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2h-7"/></svg>
                                                    </template>
                                                    <template x-if="type.value === 'supermarche'">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                                    </template>
                                                    <template x-if="type.value === 'hotel'">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M7 20v-5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v5"/><path d="M3 20V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v16"/><path d="M9 7h.01"/><path d="M15 7h.01"/><path d="M9 11h.01"/><path d="M15 11h.01"/></svg>
                                                    </template>
                                                </div>
                                                <div class="w-2 h-2 rounded-full bg-current opacity-0 transform scale-0 transition-all duration-300 peer-checked:opacity-100 peer-checked:scale-100"></div>
                                            </div>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <button type="button" @click="if(formData.name && formData.type) step = 2" 
                                :disabled="!formData.name || !formData.type"
                                class="w-full bg-[#E8AA42] text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-orange-500/20 hover:bg-[#d99b35] hover:shadow-orange-500/30 hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed">
                            Continuer l'inscription
                        </button>
                    </div>

                    <!-- STEP 2: Location -->
                    <div x-show="step === 2" 
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="space-y-8" x-cloak>
                        
                        <div>
                            <h2 class="text-3xl font-bold text-[#2D5A41] mb-2">Où êtes-vous situé ?</h2>
                            <p class="text-gray-500 text-lg">Positionnez le marqueur devant votre entrée.</p>
                        </div>

                        <div class="relative w-full h-80 rounded-2xl overflow-hidden border-2 border-gray-100 shadow-lg">
                            <div id="map" class="absolute inset-0 z-0"></div>
                            
                            <!-- Geolocation Button -->
                            <button type="button" @click="detectLocation()" 
                                    class="absolute bottom-4 right-4 bg-white p-3 rounded-xl shadow-xl border border-gray-200 z-[500] hover:bg-gray-50 active:scale-95 transition-all text-[#2D5A41]"
                                    title="Me géolocaliser">
                                <svg class="w-6 h-6" :class="{'animate-spin text-orange-500': loadingAddress}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            <div class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-white/95 backdrop-blur shadow-lg px-4 py-3 rounded-xl border border-gray-200 z-[500] flex items-center gap-3 w-[90%] max-w-sm transition-all duration-300"
                                 :class="{'opacity-50 ring-2 ring-orange-500/20': loadingAddress}">
                                <div class="w-2 h-2 rounded-full bg-green-500" :class="{'animate-pulse bg-orange-500': loadingAddress}"></div>
                                <div class="text-xs font-bold text-gray-800 truncate" x-text="formData.address || 'Déplacez le marqueur ou cliquez sur le bouton...'"></div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="latitude" x-model="formData.lat">
                        <input type="hidden" name="longitude" x-model="formData.lng">
                        <input type="hidden" name="adresse_complete" x-model="formData.address">

                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative transition-all duration-200">
                                <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between">
                                    Commune
                                    <span x-show="formData.commune" class="text-green-500 text-xs flex items-center gap-1" x-transition>
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        Détectée
                                    </span>
                                </label>
                                <select name="commune" x-model="formData.commune" 
                                        class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium cursor-pointer focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm appearance-none" 
                                        :class="{'border-green-500 bg-green-50/30': formData.commune}"
                                        required>
                                    <option value="" disabled>Choisir...</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Medina">Medina</option>
                                    <option value="Fann-Point E">Fann-Point E</option>
                                    <option value="Mermoz-Sacré Coeur">Mermoz-Sacré Coeur</option>
                                    <option value="Ouakam">Ouakam</option>
                                    <option value="Ngor">Ngor</option>
                                    <option value="Yoff">Yoff</option>
                                    <option value="Almadies">Almadies</option>
                                    <option value="Parcelles Assainies">Parcelles Assainies</option>
                                    <option value="Grand Yoff">Grand Yoff</option>
                                    <option value="Pikine">Pikine</option>
                                    <option value="Guediawaye">Guediawaye</option>
                                    <option value="Hann Bel-Air">Hann Bel-Air</option>
                                    <option value="Dieuppeul-Derklé">Dieuppeul-Derklé</option>
                                    <option value="Cambérène">Cambérène</option>
                                </select>
                            </div>
                            <div class="relative transition-all duration-200">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Complément</label>
                                <input type="text" class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm" placeholder="Ex: Face Pharmacie..." x-model="formData.details">
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" @click="step = 1" class="w-1/3 py-4 rounded-xl font-bold text-gray-500 hover:bg-white hover:text-gray-700 transition duration-300">Retour</button>
                            <button type="button" @click="step = 3" class="w-2/3 bg-[#E8AA42] text-white py-4 rounded-xl font-bold shadow-lg shadow-orange-500/20 hover:bg-[#d99b35] hover:shadow-orange-500/30 hover:-translate-y-1 transition duration-300">
                                Valider la position
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: Contact -->
                    <div x-show="step === 3" 
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="space-y-8" x-cloak>
                        
                        <div>
                            <h2 class="text-3xl font-bold text-[#2D5A41] mb-2">Dernière étape</h2>
                            <p class="text-gray-500 text-lg">Comment peut-on vous joindre ?</p>
                        </div>

                        <div class="relative transition-all duration-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Votre nom complet (Gérant)</label>
                            <input type="text" name="nom_gerant" class="peer w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm" placeholder="Prénom Nom" required>
                        </div>

                        <div class="relative transition-all duration-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" name="telephone" x-model="formData.phone" @input="formatPhone" class="peer w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm" placeholder="77 000 00 00" required>
                        </div>

                        <div class="relative transition-all duration-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email professionnel</label>
                            <input type="email" name="email" class="peer w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm" placeholder="contact@votre-commerce.sn" required>
                        </div>

                        <div class="relative transition-all duration-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mot de passe</label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="password" class="peer w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm pr-12" placeholder="8 caractères minimum" minlength="8" required autocomplete="new-password">
                                <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D5A41] transition-colors focus:outline-none">
                                    <svg x-show="!showPassword" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showPassword" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3.75 7.25c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M19.5 19.5l-15-15"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="relative transition-all duration-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Confirmer le mot de passe</label>
                            <div class="relative">
                                <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" class="peer w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 outline-none transition-all text-gray-800 font-medium placeholder-gray-400 focus:border-[#2D5A41] focus:bg-white focus:ring-4 focus:ring-[#2D5A41]/10 focus:shadow-sm pr-12" placeholder="Confirmer mot de passe" required autocomplete="new-password">
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D5A41] transition-colors focus:outline-none">
                                    <svg x-show="!showConfirmPassword" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showConfirmPassword" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3.75 7.25c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.457.221 3.553.626M19.5 19.5l-15-15"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="step = 2" class="w-1/3 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition">Retour</button>
                            <button type="submit" class="w-2/3 bg-[#E8AA42] text-white py-4 rounded-xl font-bold shadow-lg shadow-orange-500/20 hover:bg-[#d99b35] hover:shadow-orange-500/30 hover:-translate-y-1 transition duration-300">
                                Terminer l'inscription
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function onboardingForm() {
            return {
                step: 1,
                types: [
                    { value: 'boulangerie', label: 'Boulangerie', icon: '🥐' },
                    { value: 'restaurant', label: 'Restaurant', icon: '🍽️' },
                    { value: 'supermarche', label: 'Supermarché', icon: '🛒' },
                    { value: 'hotel', label: 'Hôtel / Buffet', icon: '🏨' }
                ],
                formData: {
                    name: '',
                    type: '',
                    lat: 14.6928, 
                    lng: -17.4467, 
                    address: '',
                    commune: '',
                    details: '',
                    phone: ''
                },
                showPassword: false,
                showConfirmPassword: false,
                loadingAddress: false,
                isSearching: false,
                suggestions: [],
                mapInstance: null,
                markerInstance: null,

                async searchBoutique() {
                    if (this.formData.name.length < 3) {
                        this.suggestions = [];
                        return;
                    }
                    this.isSearching = true;
                    try {
                        const q = encodeURIComponent(this.formData.name + ' Dakar Senegal');
                        const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${q}&addressdetails=1&limit=5`);
                        this.suggestions = await res.json();
                    } catch (e) {
                        console.error(e);
                    } finally {
                        this.isSearching = false;
                    }
                },

                selectBoutique(item) {
                    this.formData.name = item.display_name.split(',')[0];
                    this.formData.lat = parseFloat(item.lat);
                    this.formData.lng = parseFloat(item.lon);
                    this.formData.address = item.display_name;
                    this.suggestions = [];
                    
                    // Auto-détection de la commune basée sur les détails d'adresse
                    this.extractCommune(item.address);
                },

                formatPhone(e) {
                    this.formData.phone = e.target.value.replace(/\D/g, '');
                },

                validateAndSubmit(form) {
                    form.submit();
                },

                initMap() {
                    this.$watch('step', value => {
                        if (value === 2) {
                            setTimeout(() => this.renderMap(), 100);
                        }
                    });
                },

                renderMap() {
                    if (this.mapInstance) {
                        this.mapInstance.invalidateSize();
                        return;
                    }
                    this.mapInstance = L.map('map').setView([14.7167, -17.4677], 15);
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png').addTo(this.mapInstance);
                    this.markerInstance = L.marker([14.7167, -17.4677], { draggable: true }).addTo(this.mapInstance);
                    
                    this.markerInstance.on('dragend', () => {
                        const pos = this.markerInstance.getLatLng();
                        this.formData.lat = pos.lat;
                        this.formData.lng = pos.lng;
                        this.fetchAddress(pos.lat, pos.lng);
                    });
                },

                async fetchAddress(lat, lng) {
                    this.loadingAddress = true;
                    try {
                        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`);
                        const data = await res.json();
                        this.formData.address = data.display_name;
                        this.extractCommune(data.address);
                    } catch (e) {
                        console.error("Erreur de géocodage:", e);
                        this.formData.address = `${lat}, ${lng}`;
                    } finally {
                        this.loadingAddress = false;
                    }
                },

                extractCommune(addr) {
                    if (!addr) return;
                    const potentialFields = [
                        addr.suburb, 
                        addr.city_district, 
                        addr.town, 
                        addr.village, 
                        addr.neighbourhood,
                        addr.city,
                        addr.county
                    ];

                    const mapping = {
                        'Plateau': 'Plateau',
                        'Medina': 'Medina',
                        'Médina': 'Medina',
                        'Fann': 'Fann-Point E',
                        'Point E': 'Fann-Point E',
                        'Amitié': 'Fann-Point E',
                        'Mermoz': 'Mermoz-Sacré Coeur',
                        'Sacré-Coeur': 'Mermoz-Sacré Coeur',
                        'Sacré Coeur': 'Mermoz-Sacré Coeur',
                        'Ouakam': 'Ouakam',
                        'Ngor': 'Ngor',
                        'Yoff': 'Yoff',
                        'Almadies': 'Almadies',
                        'Parcelles': 'Parcelles Assainies',
                        'Grand Yoff': 'Grand Yoff',
                        'Pikine': 'Pikine',
                        'Guédiawaye': 'Guediawaye',
                        'Guediawaye': 'Guediawaye',
                        'Hann': 'Hann Bel-Air',
                        'Bel-Air': 'Hann Bel-Air',
                        'Sacre Coeur': 'Mermoz-Sacré Coeur',
                        'Dieuppeul': 'Dieuppeul-Derklé',
                        'Derklé': 'Dieuppeul-Derklé',
                        'Cambérène': 'Cambérène',
                        'Camberene': 'Cambérène'
                    };

                    let found = false;
                    for (const field of potentialFields) {
                        if (!field) continue;
                        const fieldLower = field.toLowerCase();
                        for (const [key, value] of Object.entries(mapping)) {
                            if (fieldLower.includes(key.toLowerCase())) {
                                this.formData.commune = value;
                                found = true;
                                break;
                            }
                        }
                        if (found) break;
                    }
                },

                detectLocation() {
                    if (!navigator.geolocation) {
                        alert("La géolocalisation n'est pas supportée par votre navigateur.");
                        return;
                    }
                    this.loadingAddress = true;
                    navigator.geolocation.getCurrentPosition((position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        this.formData.lat = lat;
                        this.formData.lng = lng;
                        
                        if (this.mapInstance) {
                            this.mapInstance.setView([lat, lng], 17);
                            this.markerInstance.setLatLng([lat, lng]);
                        }
                        this.fetchAddress(lat, lng);
                    }, () => {
                        this.loadingAddress = false;
                        alert("Impossible de récupérer votre position.");
                    });
                }
            }
        }
    </script>
</body>
</html>
