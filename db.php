<?php


require_once 'config.php';

try {
    $pdo = new PDO(
        'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
    $pdo->exec("SET search_path TO task_diary_db");  // <== ЭТО ГЛАВНОЕ

    echo "Успешное подключение к PostgreSQL!";

    $stmt = $pdo->query("SELECT title, description FROM tasks ORDER BY created_at DESC");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo "<h3>{$task['title']}</h3><p>{$task['description']}</p>";
    }

} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
