<?php
// start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// data file path constants
define('DATA_DIR', __DIR__ . '/../data');
define('USERS_FILE', DATA_DIR . '/users.json');
define('PROJECTS_FILE', DATA_DIR . '/projects.json');
