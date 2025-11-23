<?php
require_once __DIR__ . '/includes/functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

$project_id = $_POST['project_id'] ?? '';
$task_id = $_POST['task_id'] ?? '';
$status = $_POST['status'] ?? 'todo';

$allowed_status = ['todo', 'in_progress', 'done'];
if (!in_array($status, $allowed_status, true)) {
    $status = 'todo';
}

$projects = load_projects();
$changed = false;

foreach ($projects as &$project) {
    if ($project['id'] !== $project_id) {
        continue;
    }
    foreach ($project['tasks'] as &$task) {
        if ($task['id'] === $task_id) {
            $task['status'] = $status;
            $changed = true;
            break 2;
        }
    }
}

if ($changed) {
    save_projects($projects);
}

header('Location: dashboard.php');
exit;
