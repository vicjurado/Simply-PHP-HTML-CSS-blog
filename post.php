<?php
include('includes/header.php');

// Conectar a la base de datos
$id_entrada = $_GET['id_entrada'];

// Obtener la entrada
$sql = "SELECT * FROM entrada WHERE id_entrada = :id_entrada";
$resultado = $conn->prepare($sql);
$resultado->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
$resultado->execute();
$entradas = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Verificar si la entrada existe
if (count($entradas) == 0) {
    // Si la entrada no existe, redirigir al índice
    header("Location: index.php");
    exit;
}

$entrada = $entradas[0];  // Solo se espera una entrada

// Si se envió el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asegurarse de que el usuario esté logueado y sea el creador
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit;
    }

    // Obtener los nuevos valores del formulario
    $titulo = htmlspecialchars($_POST['titulo']);
    $contenido = htmlspecialchars($_POST['contenido']);

    // Actualizar la entrada en la base de datos
    $sqlUpdate = "UPDATE entrada SET 
                  titulo_entrada = :titulo,
                  contenido_entrada = :contenido
                  WHERE id_entrada = :id_entrada";

    $resultadoUpdate = $conn->prepare($sqlUpdate);
    $resultadoUpdate->bindParam(':titulo', $titulo);
    $resultadoUpdate->bindParam(':contenido', $contenido);
    $resultadoUpdate->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
    
    if ($resultadoUpdate->execute()) {
        // Redirigir a la página del post o al índice después de actualizar
        header("Location: post.php?id_entrada=$id_entrada");
        exit;
    } else {
        echo "Error al actualizar la entrada.";
    }
}
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <!-- TÍTULO ENTRADA -->
                    <h2 class="fw-bolder mb-1 mt-5"><?php echo htmlspecialchars($entrada['titulo_entrada']); ?></h2>
                </header>
                
                <!-- Información entrada -->
                <div class="text-muted fst-italic mb-2">Fecha: <?php echo htmlspecialchars($entrada['fecha_publicacion_entrada']); ?></div>

                <!-- Contenido entrada -->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><?php echo htmlspecialchars($entrada['contenido_entrada']); ?></p>
                </section>

                <!-- Botones de acción: Editar y Eliminar (SOLO PARA EL CREADOR LOGUEADO) -->
                <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $entrada['id_usuario']): ?>
                    <div class="mb-4">
                        <!-- Botón Eliminar -->
                        <form action="eliminar_post.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_entrada" value="<?php echo $entrada['id_entrada']; ?>" />
                            <button type="submit" class="btn btn-danger">Eliminar Entrada</button>
                        </form>

                        <!-- Botón Editar -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal">Editar Entrada</button>
                    </div>

                    <!-- Modal para Editar Entrada -->
                    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel">Editar Entrada</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="post.php?id_entrada=<?php echo $entrada['id_entrada']; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($entrada['titulo_entrada']); ?>" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="contenido" class="form-label">Contenido</label>
                                            <textarea class="form-control" id="contenido" name="contenido" rows="5" required><?php echo htmlspecialchars($entrada['contenido_entrada']); ?></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Actualizar Entrada</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </article>

        </div>

        <!-- ASIDE.PHP -->
        <?php include('includes/aside.php'); ?>
        <!-- // ASIDE.PHP -->
    </div>
</div>

<!-- FOOTER.PHP -->
<?php include('includes/footer.php') ?>
<!-- // FOOTER.PHP -->
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>