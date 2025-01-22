<?php
$sql = "SELECT nombre_categoria, id_categoria FROM categoria";
$resultado = $conn->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-lg-4">
    <?php if (isset($_SESSION['id_usuario'])): ?>
        <button class="btn btn-secondary mb-2" onclick="window.location.href='manejar_categorias.php'">Manejar
            CATEGORÍAS</button>
        <button class="btn btn-secondary mb-2" onclick="window.location.href='manejar_entradas.php'">Manejar
            ENTRADAS</button>
    <?php endif; ?>

    <!-- CATEGORÍAS-->
    <div class="card mb-4">
        <div class="card-header">Categorías</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?php foreach ($categorias as $categoria): ?>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="categoria.php?id_categoria=<?php echo $categoria['id_categoria'] ?>">
                                    <?php echo htmlspecialchars($categoria['nombre_categoria']); ?>
                                </a>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>