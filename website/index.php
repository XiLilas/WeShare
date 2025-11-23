<?php
$page_title = 'Connexion';
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            $errors[] = 'Veuillez remplir tous les champs de connexion.';
        } else {
            $user = authenticate($email, $password);
            if ($user) {
                login_user($user);
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = 'Email ou mot de passe incorrect.';
            }
        }
    } elseif ($action === 'register') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (!$name || !$email || !$password || !$password_confirm) {
            $errors[] = 'Veuillez remplir tous les champs d’inscription.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        } elseif ($password !== $password_confirm) {
            $errors[] = 'Les deux mots de passe ne correspondent pas.';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
        } else {
            try {
                $user = create_user($name, $email, $password);
                $success_message = "Compte créé avec succès. Vous pouvez maintenant vous connecter.";
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Connexion</h1>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success_message) ?>
            </div>
        <?php endif; ?>

        <form method="post" class="form-block">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="login_email">Email</label>
                <input type="email" id="login_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login_password">Mot de passe</label>
                <input type="password" id="login_password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
    </div>

    <div class="auth-card">
        <h2>Créer un compte</h2>
        <form method="post" class="form-block">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="reg_name">Nom</label>
                <input type="text" id="reg_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="reg_email">Email</label>
                <input type="email" id="reg_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="reg_password">Mot de passe</label>
                <input type="password" id="reg_password" name="password" required>
            </div>
            <div class="form-group">
                <label for="reg_password_confirm">Confirmer le mot de passe</label>
                <input type="password" id="reg_password_confirm" name="password_confirm" required>
            </div>
            <button type="submit" class="btn-secondary">Créer un compte</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>