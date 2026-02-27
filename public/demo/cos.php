<?php
session_start();
require_once('includes/header.php');

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

    // Dacă s-a apăsat butonul de finalizează comanda
    if (isset($_POST['finalize_order'])) {
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            // Calculăm totalul comenzii
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $price = floatval($item['price']);
                $total += $price * $item['quantity'];
            }

            // Inserăm comanda în tabela `comenzi`
            $stmt = $pdo->prepare("INSERT INTO comenzi (user_id, total) VALUES (?, ?)");
            $stmt->execute([1, $total]); // user_id = 1 pentru exemplu (poți folosi ID-ul utilizatorului logat)

            // Ștergem coșul din sesiune după plasarea comenzii
            unset($_SESSION['cart']);

            // Redirecționăm utilizatorul către pagina de confirmare a comenzii
            header("Location: comanda_finalizata.php");
            exit;
        } else {
            echo '<div class="alert alert-warning" role="alert">Coșul este gol. Nu poți finaliza comanda.</div>';
        }
    }

    // Dacă s-a apăsat butonul de golire a coșului
    if (isset($_POST['clear_cart'])) {
        // Ștergem toate produsele din coș
        unset($_SESSION['cart']);
        echo '<div class="alert alert-success" role="alert">Coșul a fost golit cu succes!</div>';
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

require_once('includes/footer.php');
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coșul tău de cumpărături</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container mt-5">
    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-striped">';
        echo '<thead><tr><th>Produs</th><th>Cantitate</th><th>Preț</th><th>Total</th></tr></thead>';
        echo '<tbody>';

        $total = 0; // Totalul coșului
        foreach ($_SESSION['cart'] as $item) {
            // Extrage doar valoarea numerică a prețului
            $price = floatval($item['price']);
            $itemTotal = $price * $item['quantity'];
            $total += $itemTotal;

            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['name']) . '</td>';
            echo '<td>' . $item['quantity'] . '</td>';
            echo '<td>' . number_format($price, 2, ',', '.') . ' RON</td>';
            echo '<td>' . number_format($itemTotal, 2, ',', '.') . ' RON</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div class="d-flex justify-content-between">';

        // Afișează totalul și butonul de finalizează comanda
        echo '<h4>Total: ' . number_format($total, 2, ',', '.') . ' RON</h4>';
        echo '<form method="POST" class="mt-3">';  
        echo '<button type="submit" name="finalize_order" class="btn btn-custom-success">Finalizează Comanda</button>';
        echo '</form>';
        
        // Butonul de golire coș
        echo '</div>';  
        echo '<div class="d-flex justify-content-end mt-3">';  
        echo '<form method="POST">';  
        echo '<button type="submit" name="clear_cart" class="btn btn-custom-danger">Golește coșul</button>';
        echo '</form>';
        echo '</div>';  

    } else {
        echo '<div class="alert alert-warning" role="alert">Coșul este gol.</div>';
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






