<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

$id_categoria = $_GET['id_categoria'];

// Obtener la categoría actual
$sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
$stmt->execute();
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si la categoría existe
if (!$categoria) {
    // Si no existe la categoría, redirigir a manejar_categorias.php
    header("Location: manejar_categorias.php");
    exit;
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);

    // Actualizar la categoría en la base de datos
    $sqlUpdate = "UPDATE categoria SET nombre_categoria = :nombre, descripcion_categoria = :descripcion WHERE id_categoria = :id_categoria";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':nombre', $nombre);
    $stmtUpdate->bindParam(':descripcion', $descripcion);
    $stmtUpdate->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    if ($stmtUpdate->execute()) {
        // Redirigir a la página de manejar categorías
        header("Location: manejar_categorias.php");
        exit;
    } else {
        echo "Error al actualizar la categoría.";
    }
}
?>

<div class="container mt-5 mb-5">
    <h2>Editar Categoría</h2>

    <form action="editar_categoria.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="<?php echo htmlspecialchars($categoria['nombre_categoria']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                required><?php echo htmlspecialchars($categoria['descripcion_categoria']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>