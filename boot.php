<?php

// Start seesion
session_start();

// Function for connect to DB
function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        if (file_exists(__DIR__ . '/config.php')) {
            $config = include __DIR__.'/config.php';
        } else {
            $msg = 'Creat config.php as config.sample.php';
            trigger_error($msg, E_USER_ERROR);
        }
        // Подключение к БД
        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}

// Function showing flash message for User
function flash(string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if ($_SESSION['flash']) { ?>
            <div id="alert-5" class="flex p-4 mt-4 md:mx-4 bg-gray-100 rounded-lg dark:bg-gray-700" role="alert">
                <div class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                    <strong><?= $_SESSION['flash']?></strong>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        <?php }
        unset($_SESSION['flash']);
    }
}

// Function Checking User Session
function check_auth(): bool
{
    return !!($_SESSION['user_id'] ?? false);
}