<?php
declare(strict_types=1);

$databaseName = getenv('DB_NAME') ?: 'practica1';
$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=utf8mb4',
    getenv('DB_HOST') ?: 'db',
    $databaseName
);

try {
    $connection = new PDO(
        $dsn,
        getenv('DB_USER') ?: '',
        getenv('DB_PASSWORD') ?: '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $connection->query('SELECT 1');
    $message = 'Conexión correcta: PHP se ha conectado a MySQL.';
    $isConnected = true;
} catch (PDOException $exception) {
    http_response_code(500);
    $message = 'No se pudo conectar con la base de datos. Comprueba que el servicio db esté iniciado y que la configuración de Compose sea correcta.';
    $isConnected = false;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Práctica 1 de Docker</title>
</head>
<body>
    <main>
        <h1>Práctica 1 de Docker</h1>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        <?php if ($isConnected): ?>
            <p>La aplicación se ejecuta en PHP 8.3-FPM y usa PDO con el controlador MySQL.</p>
        <?php else: ?>
            <p>Si acabas de iniciar los contenedores, espera unos segundos y vuelve a cargar la página.</p>
        <?php endif; ?>
    </main>
</body>
</html>
