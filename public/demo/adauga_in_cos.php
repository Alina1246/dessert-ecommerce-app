<?php
session_start(); 

// Verificăm dacă datele produsului au fost trimise
if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])) {
   
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Verificăm dacă există deja un coș în sesiune
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verificăm dacă produsul este deja în coș
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity']++;  // Dacă produsul este deja în coș, incrementăm cantitatea
            $found = true;
            break;
        }
    }

    // Dacă produsul nu există, îl adăugăm în coș
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }

    // Redirecționăm utilizatorul înapoi la pagina produsului
    header('Location: product.php?id=' . $productId);
    exit;
} else {
    // Dacă nu sunt setate datele produsului, redirecționăm către pagina principală sau afișăm o eroare
    header('Location: index.php');
    exit;
}
?>
