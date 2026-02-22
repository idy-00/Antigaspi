<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { text-align: center; font-size: 12px; color: #999; margin-top: 30px; }
        h1 { color: #2D5A41; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #E8AA42; color: white !important; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Anti-Gaspi SN</h1>
        </div>
        
        <p>Bonjour {{ $user->nom_gerant }},</p>
        
        <p>Merci de votre inscription pour l'établissement <strong>{{ $user->nom_commerce }}</strong> !</p>
        
        <p>Votre dossier est actuellement en cours d'examen par notre équipe. Une fois validé, vous recevrez un second mail vous informant de l'activation de votre compte.</p>
        
        <p>Vous pouvez déjà consulter votre espace en utilisant les identifiants saisis lors de l'inscription.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/dashboard') }}" class="btn">Accéder à mon tableau de bord</a>
        </div>
        
        <p>Merci de nous aider à lutter contre le gaspillage alimentaire au Sénégal !</p>
        
        <p>Cordialement,<br>L'équipe Anti-Gaspi SN</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} Anti-Gaspi SN. Tous droits réservés.
        </div>
    </div>
</body>
</html>
