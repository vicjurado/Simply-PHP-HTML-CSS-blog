<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'] ?? '';
    $descripcion_categoria = $_POST['descripcion_categoria'] ?? '';

    // Validar campos
    if (empty($nombre_categoria)) {
        $error = "El nombre de la categoría es obligatorio.";
    } else {
        try {
            // Insertar la categoría en la base de datos
            $sql = "INSERT INTO categoria (nombre_categoria, descripcion_categoria) VALUES (:nombre_categoria, :descripcion_categoria)";
            $resultado = $conn->prepare($sql);
            $resultado->bindParam(':nombre_categoria', $nombre_categoria, PDO::PARAM_STR);
            $resultado->bindParam(':descripcion_categoria', $descripcion_categoria, PDO::PARAM_STR);
            $resultado->execute();

            // Redirigir a la página de manejo de categorías
            header("Location: manejar_categorias.php");
            exit;
        } catch (PDOException $e) {
            $error = "Error al crear la categoría: " . $e->getMessage();
        }
    }
}
?>

<div class="container mt-5 mb-5">
    <h2>Crear Nueva Categoría</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="crear_categoria.php" method="POST">
        <div class="mb-3">
            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
        </div>
        <div class="mb-3">
            <label for="descripcion_categoria" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion_categoria" name="descripcion_categoria" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="manejar_categorias.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>