<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Simulation d'une base de données utilisateur avec un tableau associatif
$users = [
    'user1' => 'superbg',    // Utilisateur "user1" avec mot de passe "superbg"
    'user2' => 'miaou',   // Utilisateur "user2" avec mot de passe "miaou"
    'admin' => 'admin123',    // Utilisateur "admin" avec mot de passe "admin123"
];

// Vérification si la méthode de la requête HTTP est POST pour traiter les données de formulaire envoyées
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération du nom d'utilisateur et du mot de passe depuis le formulaire, avec utilisation de l'opérateur null coalescent pour éviter les notices PHP si les indices n'existent pas
    $username = $_POST['pseudo'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification si le nom d'utilisateur existe dans la "base de données" et si le mot de passe correspond
    if (isset($users[$username]) && $users[$username] == $password) {
        // Si valide, le nom d'utilisateur est stocké dans une variable de session
        $_SESSION['username'] = $username;

        // Regénération de l'ID de session pour la sécurité (évite l'exploitation de session fixation)
        session_regenerate_id(true);

        // Redirection de l'utilisateur vers la page des commentaires
        header('Location: comments.php');
        exit; // Arrêt du script pour éviter l'exécution de code supplémentaire après la redirection
    } else {
        // Si les identifiants sont incorrects, préparation d'un message d'erreur
        $error = 'Identifiants incorrects!';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-200 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-xl mb-4">Connexion</h1>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pseudo">Nom d'utilisateur</label>
                    <input type="text" id="pseudo" name="pseudo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <?php if (!empty($error)): ?>
                    <p class="text-red-500 text-xs italic"><?php echo $error; ?></p>
                <?php endif; ?>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>
