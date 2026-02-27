
<?php require_once('includes/header.php'); ?>

<?php

$host = 'localhost';
$port = '10011';
$db = 'local';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validare date
    if (empty($email) || empty($password)) {
        $error = "Te rugăm să completezi toate câmpurile!";
    } else {
        // Verificare dacă email-ul există deja
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $error = "Email-ul este deja înregistrat!";
        } else {
            // Hash parola și inserează utilizatorul
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $stmt->execute(['email' => $email, 'password' => $hashed_password]);

            $success = "Cont creat cu succes!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Înregistrare</h2>
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Parolă</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit" class="btn btn-outline-light btn-lg px-5">Înregistrează-te</button></div>
                    </form>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success mt-3">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <p class="text-center mt-3">Ai deja un cont? <a href="login.php">Autentifică-te</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php require_once('includes/footer.php'); ?>
