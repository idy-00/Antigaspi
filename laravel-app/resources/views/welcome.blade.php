<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anti-Gaspi SN | Valorisons nos ressources locales</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- CSS Frameworks -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --forest: #2D5A41;
            --cream: #FDFCF0;
            --white-soft: #ffffff;
            --accent: #E8AA42;
        }

        body {
            background-color: var(--cream);
            color: #1F2937;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: radial-gradient(circle at top right, rgba(45, 90, 65, 0.03), var(--cream) 70%);
        }

        h1, h2, h3, h4, h5, .nav-link, .btn {
            font-family: 'Outfit', sans-serif;
        }

        /* Navbar Glassmorphism */
        .navbar-custom {
            background: rgba(45, 90, 65, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 15px 0;
            transition: all 0.3s;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link { 
            color: rgba(253, 252, 240, 0.9) !important; 
            font-weight: 500; 
            margin: 0 10px;
            font-size: 0.95rem;
            position: relative;
            transition: 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent);
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: var(--white-soft) !important; }

        .btn-engage {
            background-color: var(--accent);
            color: white !important;
            border-radius: 50px;
            padding: 10px 25px !important;
            font-weight: 700 !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 15px rgba(232, 170, 66, 0.3);
            border: 2px solid transparent;
        }
        
        .btn-engage:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 25px rgba(232, 170, 66, 0.4);
            background-color: #f7b74d;
            border-color: rgba(255,255,255,0.2);
        }

        /* Hero Section */
        .hero-section {
            padding-top: 160px;
            padding-bottom: 100px;
            background: radial-gradient(circle at top right, rgba(45, 90, 65, 0.05), transparent 60%);
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 4rem;
            line-height: 1.05;
            color: var(--forest);
            letter-spacing: -0.02em;
        }

        .hero-img-container {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Features */
        .feature-card {
            background: white;
            border: 1px solid rgba(45, 90, 65, 0.1);
            border-radius: 24px;
            padding: 40px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--forest);
            box-shadow: 0 20px 40px -10px rgba(45, 90, 65, 0.1);
        }

        .bg-forest { background-color: var(--forest); color: var(--cream); }
        
        /* Custom Buttons */
        .btn-primary-custom {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px -5px rgba(232, 170, 66, 0.3);
        }
        
        .step-circle {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* High Visibility Arrow */
        .header-arrow {
            position: absolute;
            top: 60px;
            right: 0;
            width: 50px;
            height: 50px;
            z-index: 2000;
            pointer-events: none;
            animation: arrow-float 1.5s infinite ease-in-out;
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.3));
        }

        @keyframes arrow-float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(10px) rotate(5deg); }
        }

        @media (max-width: 991px) {
            .header-arrow { display: none; }
        }

        .btn-outline-custom {
            border: 2px solid var(--forest);
            color: var(--forest);
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: 600;
            background: transparent;
            transition: all 0.3s;
        }

        .btn-outline-custom:hover {
            background: var(--forest);
            color: white;
        }

        .btn-outline-custom:hover {
            background: var(--forest);
            color: white;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white fs-4" href="{{ url('/') }}">
                ANTI-GASPI<span class="opacity-50">.SN</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
 
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#application">L'Application</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pourquoi">Notre Mission</a></li>
                    <li class="nav-item"><a class="nav-link" href="#partenaires">Commerçants</a></li>
                    
                    @auth
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link btn-engage" href="{{ route('dashboard') }}">Mon Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link px-3 font-bold text-[#E8AA42]" href="{{ route('login') }}">Connexion</a></li>
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link btn-engage" href="{{ route('register') }}">Espace Partenaire</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    
                    <h1 class="hero-title fw-bold mb-4">
                        Sauvez des repas,<br>
                        <span style="color: #4A7A5D">Partagez la Teranga.</span>
                    </h1>
                    <p class="lead mb-5 text-secondary" style="max-width: 90%;">
                        L'application n°1 au Sénégal qui connecte les commerçants responsables et les citoyens pour lutter contre le gaspillage alimentaire. Simple, économique, et solidaire.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary-custom text-decoration-none">
                                Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn-outline-custom text-decoration-none">
                                Devenir Partenaire
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn-primary-custom text-decoration-none">
                                Accéder au Dashboard
                            </a>
                        @endguest
                    </div>
                    
                    <div class="mt-5 d-flex align-items-center gap-4 opacity-75">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-green-100 p-2 rounded-circle text-forest">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                            </div>
                            <small class="fw-bold">19 Communes</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-green-100 p-2 rounded-circle text-forest">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/></svg>
                            </div>
                            <small class="fw-bold">-50% sur les paniers</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="100">
                    <div class="hero-img-container">
                        <img src="{{ asset('ChatGPT Image 4 janv. 2026, 23_14_05.png') }}" alt="Application Anti-Gaspi Interface" class="img-fluid" style="max-height: 600px; filter: drop-shadow(0 20px 40px rgba(45,90,65,0.25)); transform: scale(1.1);">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- App Features Section -->
    <section class="py-20" id="application">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="display-6 fw-bold text-forest mb-3">Comment ça marche ?</h2>
                    <p class="text-secondary text-lg">Une solution simple pour tout le monde.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="feature-card text-center">
                        <div class="bg-green-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4 text-forest text-3xl">
                            📍
                        </div>
                        <h3 class="h4 fw-bold mb-3">Géolocalisez</h3>
                        <p class="text-secondary opacity-80">Trouvez les commerçants partenaires autour de vous à Dakar qui proposent des paniers anti-gaspi.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card text-center">
                        <div class="bg-green-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4 text-forest text-3xl">
                            🛍️
                        </div>
                        <h3 class="h4 fw-bold mb-3">Réservez</h3>
                        <p class="text-secondary opacity-80">Payez directement sur l'application à petit prix (souvent 50% moins cher que le prix initial).</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card text-center">
                        <div class="bg-green-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4 text-forest text-3xl">
                            🤝
                        </div>
                        <h3 class="h4 fw-bold mb-3">Récupérez</h3>
                        <p class="text-secondary opacity-80">Passez au magasin à l'heure indiquée, montrez votre reçu sur l'app, et profitez !</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Section -->
    <section class="py-20 bg-[#F5F8F6]" id="pourquoi">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100">
                        <div class="display-2 fw-bold text-forest mb-2">2026</div>
                        <p class="h5 fw-medium text-black mb-4">Objectif Zéro Gaspi</p>
                        <hr class="my-4 text-gray-200">
                        <p class="text-secondary">
                            Chaque année, des tonnes de nourriture finissent à la poubelle alors qu'elles sont parfaitement consommables.
                            <br><br>
                            Notre mission est de connecter ceux qui ont trop avec ceux qui veulent manger mieux pour moins cher.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
                    <h2 class="display-5 fw-bold text-forest mb-4">Un impact réel sur votre quotidien</h2>
                    
                    <div class="d-flex gap-4 mb-4 align-items-start">
                        <div class="bg-forest text-white rounded-circle p-2 flex-shrink-0 mt-1">✓</div>
                        <div>
                            <h4 class="h5 fw-bold text-black">Économies Directes</h4>
                            <p class="text-secondary">Réduisez votre budget alimentaire mensuel sans sacrifier la qualité.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-4 mb-4 align-items-start">
                        <div class="bg-forest text-white rounded-circle p-2 flex-shrink-0 mt-1">✓</div>
                        <div>
                            <h4 class="h5 fw-bold text-black">Soutien Local</h4>
                            <p class="text-secondary">Aidez les commerçants de votre quartier à ne pas jeter leurs productions.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-4 align-items-start">
                        <div class="bg-forest text-white rounded-circle p-2 flex-shrink-0 mt-1">✓</div>
                        <div>
                            <h4 class="h5 fw-bold text-black">Écologie Concrète</h4>
                            <p class="text-secondary">Moins de déchets, c'est moins de pollution pour Dakar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner CTA -->
    <section class="py-5 bg-forest text-white" id="partenaires">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="display-4 fw-bold mb-4">
                        🤝 <br>
                        Devenez <br>
                        <span class="text-warning">Partenaire.</span>
                    </h2>
                    <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 600px;">
                        Inscrivez votre commerce en 2 minutes. Valorisez vos invendus et attirez de nouveaux clients dakarois.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-forest hover:scale-105 transition-transform shadow-lg">
                        Devenir Partenaire
                    </a>
                    <p class="mt-4 text-sm opacity-60">
                        Inscription gratuite • Sans engagement • Installation en 5 min
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1A2E24] text-white py-12 border-t border-[#ffffff10]">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4">
                    <h4 class="fw-bold mb-4 text-2xl">ANTI-GASPI<span class="opacity-50">.SN</span></h4>
                    <p class="opacity-60 mb-4">
                        La première plateforme digitale de lutte contre le gaspillage alimentaire au Sénégal.
                    </p>
                    <div class="d-flex gap-3 social-links">
                        <a href="#" class="text-white opacity-50 hover:opacity-100 transition">Instagram</a>
                        <a href="#" class="text-white opacity-50 hover:opacity-100 transition">Facebook</a>
                        <a href="#" class="text-white opacity-50 hover:opacity-100 transition">Twitter</a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4">Navigation</h5>
                    <ul class="list-unstyled opacity-70 space-y-2">
                        <li><a href="#home" class="text-white text-decoration-none hover:text-green-300">Accueil</a></li>
                        <li><a href="#application" class="text-white text-decoration-none hover:text-green-300">L'Application</a></li>
                        <li><a href="#pourquoi" class="text-white text-decoration-none hover:text-green-300">Mission</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4">Partenaires</h5>
                    <ul class="list-unstyled opacity-70 space-y-2">
                        <li><a href="{{ route('register') }}" class="text-white text-decoration-none hover:text-green-300">S'inscrire</a></li>
                        <li><a href="{{ route('login') }}" class="text-white text-decoration-none hover:text-green-300">Connexion</a></li>
                        <li><a href="#" class="text-white text-decoration-none hover:text-green-300">Aide</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-4">Restez informé</h5>
                    <form class="d-flex gap-2">
                        <input type="email" class="form-control bg-transparent border-[#ffffff20] text-white" placeholder="Votre email">
                        <button class="btn btn-light" type="button">Ok</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-[#ffffff10] mt-10 pt-8 text-center opacity-40 text-sm">
                &copy; {{ date('Y') }} Anti-Gaspi SN. Fait avec passion à Dakar.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ 
            duration: 1000, 
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                nav.style.padding = '8px 0';
                nav.style.background = 'rgba(45, 90, 65, 0.98)';
                nav.classList.add('shadow-xl');
            } else {
                nav.style.padding = '15px 0';
                nav.style.background = 'rgba(45, 90, 65, 0.95)';
                nav.classList.remove('shadow-xl');
            }
        });

        // Hero Parallax Mouse Effect
        document.addEventListener('mousemove', function(e) {
            const heroImg = document.querySelector('.hero-img-container img');
            if(!heroImg) return;
            
            const moveX = (e.clientX - window.innerWidth / 2) / 50;
            const moveY = (e.clientY - window.innerHeight / 2) / 50;
            
            heroImg.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
        });
    </script>
</body>
</html>
