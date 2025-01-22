<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

// Conectar a la base de datos
// Asegúrate de haber establecido la conexión en tu archivo de configuración

// Obtener las entradas del usuario
$sql = "SELECT * FROM entrada WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
$stmt->execute();
$entradas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container mt-5 mb-5">
    <h2>Manejar Entradas</h2>

    <!-- Crear Entrada -->
    <a href="crear_post.php" class="btn btn-success mb-3">Crear Entrada</a>

    <!-- Tabla de Entradas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Contenido</th>
                <th>Fecha de Publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entradas as $entrada): ?>
                <tr>
                    <td><?php echo $entrada['id_entrada']; ?></td>
                    <td><?php echo htmlspecialchars($entrada['titulo_entrada']); ?></td>
                    <td><?php echo htmlspecialchars(substr($entrada['contenido_entrada'], 0, 50)) . '...'; ?></td>
                    <td><?php echo htmlspecialchars($entrada['fecha_publicacion_entrada']); ?></td>
                    <td>
                        <!-- Botón Editar -->
                        <a href="editar_post.php?id_entrada=<?php echo $entrada['id_entrada']; ?>"
                            class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para Eliminar -->
                        <form action="eliminar_post.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_entrada" value="<?php echo $entrada['id_entrada']; ?>" />
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>