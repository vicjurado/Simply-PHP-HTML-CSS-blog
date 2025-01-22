<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

// Verificar si se ha recibido el ID de la entrada en la URL
if (isset($_GET['id_entrada'])) {
    $id_entrada = $_GET['id_entrada'];

    // Obtener la entrada
    $sql = "SELECT * FROM entrada WHERE id_entrada = :id_entrada";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
    $stmt->execute();
    $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si la entrada existe y si el usuario es el creador
    if ($entrada && $entrada['id_usuario'] == $_SESSION['id_usuario']) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = htmlspecialchars($_POST['titulo']);
            $contenido = htmlspecialchars($_POST['contenido']);

            // Actualizar la entrada en la base de datos
            $sqlUpdate = "UPDATE entrada SET 
                          titulo_entrada = :titulo,
                          contenido_entrada = :contenido
                          WHERE id_entrada = :id_entrada";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':titulo', $titulo);
            $stmtUpdate->bindParam(':contenido', $contenido);
            $stmtUpdate->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);

            if ($stmtUpdate->execute()) {
                // Redirigir a la página del post actualizado
                header("Location: post.php?id_entrada=$id_entrada");
                exit;
            } else {
                echo "Error al actualizar la entrada.";
            }
        }
    } else {
        echo "La entrada no existe o no tienes permiso para editarla.";
        exit;
    }
} else {
    echo "No se ha recibido el ID de la entrada.";
    exit;
}
?>

<div class="container mt-5 mb-5">
    <h2>Editar Entrada</h2>

    <form action="editar_post.php?id_entrada=<?php echo $id_entrada; ?>" method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                value="<?php echo htmlspecialchars($entrada['titulo_entrada']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5"
                required><?php echo htmlspecialchars($entrada['contenido_entrada']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Entrada</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>