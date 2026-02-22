<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merci | ANTI-GASPI.SN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FDFCF0; }
        h1 { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white p-8 rounded-3xl shadow-xl text-center border border-green-50">
        <div class="w-20 h-20 bg-green-100 text-[#2D5A41] rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-[#2D5A41] mb-4">Demande reçue !</h1>
        
        <p class="text-gray-600 mb-6 leading-relaxed">
            Merci de vouloir rejoindre la communauté Anti-Gaspi.
            <br>
            Nous avons bien reçu votre demande d'inscription. Un email de confirmation vient de vous être envoyé.
        </p>

        <div class="bg-yellow-50 border border-yellow-100 p-4 rounded-xl mb-8">
            <p class="text-sm text-yellow-800">
                <strong>Prochaine étape :</strong> Notez équipe va vérifier vos informations et activer votre compte sous 24h ouvrées.
            </p>
        </div>

        <a href="{{ url('/') }}" class="block w-full bg-[#2D5A41] text-white font-bold py-3 rounded-xl hover:bg-[#234633] transition text-decoration-none">
            Retour à l'accueil
        </a>
    </div>

</body>
</html>
