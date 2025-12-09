<?php
require_once __DIR__ . '/functions.php';
$user = current_user();
$page_title = $page_title ?? 'WeShare';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($page_title) ?> - WeShare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/style.css?v=<?= filemtime(__DIR__ . '/../assets/style.css') ?>">
</head>

<body>
    <header class="main-header">
        <div class="container header-inner">
            <div class="logo">
                <a href="dashboard.php">WeShare</a>
            </div>
            <nav class="main-nav">
                <?php if ($user): ?>
                    <a href="dashboard.php">Mes projets</a>
                    <a href="weekly_view.php">📅 Vue semaine</a>
                    <a href="stats_view.php">📊 Statistiques</a>
                    <a href="create_project.php">Créer un projet</a>
                    <a href="https://docs.google.com/forms/d/1SS989KXdaYyGMW5mesaFTyp1SbFLBU2juvcGhXl45nY/viewform?edit_requested=true" target="_blank" class="questionnaire-link">📋 Questionnaire</a>
                    <span class="user-label">Bonjour, <?= htmlspecialchars($user['name'] ?? '') ?></span>
                    <a href="logout.php" class="btn-logout">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php">Connexion</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container main-content">
