<!-- HEADER.PHP -->
<?php include('includes/header.php'); ?>
<!-- // HEADER.PHP -->

<!-- Contenido página -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Contenido de post-->
            <article>
                <?php
                // Definir cuántas entradas mostrar por página
                $entradas_por_pagina = 5;

                // Obtener la página actual
                $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                $pagina_actual = $pagina_actual < 1 ? 1 : $pagina_actual;

                // Calcular el inicio de los resultados
                $inicio = ($pagina_actual - 1) * $entradas_por_pagina;

                // Consulta para obtener las entradas con LIMIT y OFFSET, ordenadas de más recientes a más antiguas
                $sql = 'SELECT * FROM entrada ORDER BY fecha_publicacion_entrada DESC LIMIT :limite OFFSET :offset';
                $resultado = $conn->prepare($sql);
                $resultado->bindParam(':limite', $entradas_por_pagina, PDO::PARAM_INT);
                $resultado->bindParam(':offset', $inicio, PDO::PARAM_INT);
                $resultado->execute();
                $entradas = $resultado->fetchAll(PDO::FETCH_ASSOC);

                // Obtener el número total de entradas
                $sql_total = 'SELECT COUNT(*) FROM entrada';
                $resultado_total = $conn->query($sql_total);
                $total_entradas = $resultado_total->fetchColumn();

                // Calcular el número total de páginas
                $total_paginas = ceil($total_entradas / $entradas_por_pagina);
                ?>

                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">Bienvenido al Blog</h1>

                    <!-- INICIO BUCLE -->
                    <?php foreach ($entradas as $datos): ?>
                        <!-- TÍTULO ENTRADA -->
                        <h2 class="fw-bolder mb-1 mt-5"><?php echo htmlspecialchars($datos['titulo_entrada']); ?></h2>
                    </header>

                    <!-- Información entrada-->
                    <div class="text-muted fst-italic mb-2">Fecha:
                        <?php echo htmlspecialchars($datos['fecha_publicacion_entrada']); ?></div>

                    <!-- Contenido entrada -->
                    <section class="mb-5">
                        <p class="fs-5 mb-4"><?php echo recortarTexto(($datos['contenido_entrada'])); ?></p>
                        <a class="btn bg-secondary text-decoration-none link-light"
                            href="post.php?id_entrada=<?php echo $datos['id_entrada'] ?>"><?php echo $leer_mas ?></a>
                    </section>
                <?php endforeach; ?>

                <!-- Paginación -->
                <div class="pagination">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagina_actual > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=1">&laquo; Primero</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagina_actual < $total_paginas): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $total_paginas; ?>">Último &raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

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