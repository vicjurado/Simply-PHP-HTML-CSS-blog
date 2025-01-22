<?php
include('includes/header.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener todas las categorías
$sql = "SELECT * FROM categoria";
$resultado = $conn->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = htmlspecialchars($_POST['titulo']);
    $contenido = htmlspecialchars($_POST['contenido']);
    $categoria = $_POST['categoria']; // ID de la categoría seleccionada

    // Insertar la entrada en la tabla `entrada`
    $sqlInsert = "INSERT INTO entrada (titulo_entrada, contenido_entrada, id_usuario) 
                  VALUES (:titulo, :contenido, :id_usuario)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindParam(':titulo', $titulo);
    $stmtInsert->bindParam(':contenido', $contenido);
    $stmtInsert->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
    $stmtInsert->execute();

    // Obtener el ID de la entrada recién insertada
    $id_entrada = $conn->lastInsertId();

    // Insertar la relación entre la entrada y la categoría seleccionada
    $sqlInsertCategoria = "INSERT INTO entrada_categoria (id_entrada, id_categoria) VALUES (:id_entrada, :id_categoria)";
    $stmtInsertCategoria = $conn->prepare($sqlInsertCategoria);
    $stmtInsertCategoria->bindParam(':id_entrada', $id_entrada, PDO::PARAM_INT);
    $stmtInsertCategoria->bindParam(':id_categoria', $categoria, PDO::PARAM_INT);
    $stmtInsertCategoria->execute();

    // Redirigir al post recién creado
    header("Location: post.php?id_entrada=$id_entrada");
    exit;
}
?>

<!-- Formulario de creación de entrada -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <h2>Crear Nueva Entrada</h2>
            <form action="crear_post.php" method="POST">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                </div>

                <!-- Seleccionar categoría -->
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>">
                                <?php echo $categoria['nombre_categoria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Entrada</button>
            </form>
        </div>
    </div>
</div>

<!-- FOOTER.PHP -->
<?php include('includes/footer.php'); ?>