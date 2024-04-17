<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: comments.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex flex-col items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-3/4 md:w-1/2 lg:w-1/3">
    <h1 class="text-2xl font-bold mb-4">Bienvenue sur Notre Plateforme de Commentaires!</h1>
    <p class="text-lg mb-6">
        Ce site permet à nos utilisateurs enregistrés de poster des commentaires et de participer à des discussions en ligne.
        Connectez-vous pour accéder à votre espace utilisateur et commencer à interagir avec la communauté.
    </p>
    <a href="login.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Se connecter
    </a>
</div>
</body>
</html>
