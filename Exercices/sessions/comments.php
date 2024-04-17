<?php
// Démarre ou reprend une session existante. Ceci est nécessaire pour accéder aux variables de session.
session_start();

// Vérifie si l'utilisateur est déjà connecté. Si non, redirige vers la page de connexion.
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirection vers login.php si aucun utilisateur n'est connecté
    exit; // Arrête l'exécution du script après la redirection pour sécuriser l'app
}

// Récupération des commentaires stockés en session. Utilise un tableau vide comme valeur par défaut si 'comments' n'est pas encore défini.
$comments = $_SESSION['comments'] ?? [];

// Vérification si la requête est de type POST et que le champ 'comment' n'est pas vide
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['comment'])) {
    // Ajout du commentaire dans la session. Chaque commentaire est un tableau associatif contenant le nom d'utilisateur et le commentaire.
    $_SESSION['comments'][] = ['user' => $_SESSION['username'], 'comment' => $_POST['comment']]; // Stockage du commentaire avec le nom d'utilisateur associé

    // Redirection vers comments.php pour éviter le rechargement du formulaire et la soumission multiple du même commentaire
    header('Location: comments.php');
    exit; // Arrête l'exécution du script après la redirection
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commentaires</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-200 flex flex-col items-center justify-center min-h-screen">
    <a href="logout.php" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded absolute top-0 right-0 mr-5">Se déconnecter</a>

    <div class="bg-white p-8 rounded-lg shadow-md w-1/2 mb-10">
        <h2 class="text-lg">Liste des Commentaires</h2>
        <?php foreach ($comments as $comment): ?>
            <h4 class="bold border-t border-gray-300 pt-2 mt-3">Utilisateur: <?= $comment['user'] ?></h4>
            <p class="">Message: <?= htmlspecialchars($comment['comment']) ?></p>
        <?php endforeach; ?>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
            <h1 class="text-xl mb-4">Bienvenue, <?= htmlspecialchars($_SESSION['username']) ?></h1>
            <form method="POST" class="mb-4">
                <textarea name="comment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre commentaire..." required></textarea>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Poster</button>
            </form>
        </div>
    </body>
</html>
