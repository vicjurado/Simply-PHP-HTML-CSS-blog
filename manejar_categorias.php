<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit;
}

// Conectar a la base de datos
// Asegúrate de haber establecido la conexión en tu archivo de configuración

// Obtener las categorías
$sql = "SELECT * FROM categoria";
$resultado = $conn->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5 mb-5">
    <h2>Manejar Categorías</h2>

    <!-- Crear Categoría -->
    <a href="crear_categoria.php" class="btn btn-success mb-3">Crear Categoría</a>

    <!-- Tabla de Categorías -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria['id_categoria']; ?></td>
                    <td><?php echo htmlspecialchars($categoria['nombre_categoria']); ?></td>
                    <td><?php echo htmlspecialchars($categoria['descripcion_categoria']); ?></td>
                    <td>
                        <!-- Botón Editar -->
                        <a href="editar_categoria.php?id_categoria=<?php echo $categoria['id_categoria']; ?>"
                            class="btn btn-warning btn-sm">Editar</a>

                        <!-- Verificar si la categoría está asociada a alguna entrada -->
                        <?php
                        $sqlCheck = "SELECT COUNT(*) FROM entrada_categoria WHERE id_categoria = :id_categoria";
                        $stmtCheck = $conn->prepare($sqlCheck);
                        $stmtCheck->bindParam(':id_categoria', $categoria['id_categoria'], PDO::PARAM_INT);
                        $stmtCheck->execute();
                        $count = $stmtCheck->fetchColumn();
                        ?>

                        <!-- Mostrar el botón de eliminar -->
                        <form action="eliminar_categoria.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>" />
                            <!-- Si la categoría tiene entradas asociadas, agrega un mensaje de confirmación -->
                            <?php if ($count > 0): ?>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmarEliminacion(<?php echo $categoria['id_categoria']; ?>)">Eliminar</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            <?php endif; ?>
                        </form>

                        <script>
                            function confirmarEliminacion(id_categoria) {
                                if (confirm("Esta categoría tiene entradas asociadas. ¿Estás seguro de que deseas eliminarla?")) {
                                    // Si confirma, redirige al formulario de eliminación
                                    window.location.href = "eliminar_categoria.php?id_categoria=" + id_categoria;
                                }
                            }
                        </script>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>