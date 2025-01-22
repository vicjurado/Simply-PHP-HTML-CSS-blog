<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Verificar si se recibió el ID de la categoría para confirmar la eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria'])) {
    $id_categoria = intval($_POST['id_categoria']);

    // Conectar a la base de datos y eliminar la categoría
    $sqlDelete = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        // Redirigir a la página de manejar categorías
        header("Location: manejar_categorias.php");
        exit;
    } else {
        $error = "Error al eliminar la categoría. Inténtalo nuevamente.";
    }
}

// Verificar si se recibió el ID de la categoría para mostrar confirmación
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_categoria'])) {
    $id_categoria = intval($_GET['id_categoria']);

    // Verificar si la categoría tiene entradas asociadas
    $sqlCheck = "SELECT COUNT(*) FROM entrada_categoria WHERE id_categoria = :id_categoria";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    // Eliminar directamente si no hay entradas asociadas
    $sqlDelete = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        header("Location: manejar_categorias.php");
        exit;
    } else {
        $error = "Error al eliminar la categoría. Inténtalo nuevamente.";
    }
} else {
    echo "No se recibió el ID de la categoría.";
}

// Mostrar mensaje de error si ocurrió algún problema
if (isset($error)) {
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<?php include('includes/footer.php'); ?>