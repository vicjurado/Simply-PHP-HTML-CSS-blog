<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

// Verificar si se ha enviado un ID de entrada para eliminar
if (isset($_POST['id_entrada'])) {
    $id_entrada = $_POST['id_entrada'];

    // Verificar si la entrada existe
    $sql = "SELECT * FROM entrada WHERE id_entrada = :id_entrada";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
    $stmt->execute();
    $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($entrada) {
        // Verificar si el usuario logueado es el creador de la entrada
        if ($entrada['id_usuario'] == $_SESSION['id_usuario']) {
            // Eliminar la entrada de la base de datos
            $sqlDelete = "DELETE FROM entrada WHERE id_entrada = :id_entrada";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
            $stmtDelete->execute();

            // Eliminar la relación de categoría si es necesario
            $sqlDeleteCategoria = "DELETE FROM entrada_categoria WHERE id_entrada = :id_entrada";
            $stmtDeleteCategoria = $conn->prepare($sqlDeleteCategoria);
            $stmtDeleteCategoria->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
            $stmtDeleteCategoria->execute();

            // Redirigir al índice después de eliminar la entrada
            header("Location: manejar_entradas.php");
            exit;
        } else {
            echo "No tienes permiso para eliminar esta entrada.";
        }
    } else {
        echo "La entrada no existe.";
    }
} else {
    echo "No se ha recibido el ID de la entrada.";
}

?>