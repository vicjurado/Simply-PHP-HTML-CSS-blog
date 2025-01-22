<!-- HEADER.PHP -->
<?php include('includes/header.php'); ?>
<!-- // HEADER.PHP -->

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">

            <article>
                <?php
                if (isset($_GET['id_categoria'])) {
                    $id_categoria = (int) $_GET['id_categoria'];
                } else {
                    echo "Categoría no encontrada.";
                    exit;
                }

                $entradas_por_pagina = 5;

                // Obtener la página actual (por defecto la primera página)
                $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                $pagina_actual = $pagina_actual < 1 ? 1 : $pagina_actual;

                // Calcular el inicio de los resultados
                $inicio = ($pagina_actual - 1) * $entradas_por_pagina;

                // Consulta para obtener las entradas relacionadas con la categoría con LIMIT y OFFSET, ordenadas por fecha descendente
                $sql = "SELECT e.* 
                        FROM entrada e
                        JOIN entrada_categoria ec ON e.id_entrada = ec.id_entrada
                        WHERE ec.id_categoria = :id_categoria
                        ORDER BY e.fecha_publicacion_entrada DESC
                        LIMIT :limite OFFSET :offset";
                $resultado = $conn->prepare($sql);
                $resultado->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
                $resultado->bindParam(':limite', $entradas_por_pagina, PDO::PARAM_INT);
                $resultado->bindParam(':offset', $inicio, PDO::PARAM_INT);
                $resultado->execute();

                // Obtener todas las entradas relacionadas con la categoría
                $entradas = $resultado->fetchAll(PDO::FETCH_ASSOC);

                // Verificar si hay entradas para mostrar
                if (count($entradas) === 0) {
                    echo "<p>No hay entradas disponibles para esta categoría.</p>";
                }

                // Obtener el número total de entradas para la categoría (sin LIMIT ni OFFSET)
                $sql_total = "SELECT COUNT(*) 
                              FROM entrada e
                              JOIN entrada_categoria ec ON e.id_entrada = ec.id_entrada
                              WHERE ec.id_categoria = :id_categoria";
                $resultado_total = $conn->prepare($sql_total);
                $resultado_total->execute([':id_categoria' => $id_categoria]);
                $total_entradas = $resultado_total->fetchColumn();

                // Calcular el número total de páginas
                $total_paginas = ceil($total_entradas / $entradas_por_pagina);
                ?>

                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">Entradas de la Categoría</h1>
                </header>

                <!-- INICIO BUCLE -->
                <?php foreach ($entradas as $datos): ?>
                    <!-- TÍTULO ENTRADA -->
                    <h2 class="fw-bolder mb-1 mt-5"><?php echo htmlspecialchars($datos['titulo_entrada']); ?></h2>

                    <!-- DATOS DEL POST -->
                    <div class="text-muted fst-italic mb-2">
                        <?php echo htmlspecialchars($datos['fecha_publicacion_entrada']); ?>
                    </div>

                    <!-- CONTENIDO DEL POST -->
                    <section class="mb-5">
                        <p class="fs-5 mb-4"><?php echo recortarTexto($datos['contenido_entrada']); ?></p>
                        <a class="btn bg-secondary text-decoration-none link-light"
                            href="post.php?id_entrada=<?php echo $datos['id_entrada'] ?>">Leer más</a>
                    </section>

                <?php endforeach; ?>
                <!-- FIN BUCLE -->

                <!-- Paginación -->
                <div class="pagination">
                    <ul class="pagination justify-content-center">
                        <!-- Enlace a la primera página -->
                        <?php if ($pagina_actual > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?id_categoria=<?php echo $id_categoria; ?>&pagina=1">&laquo;
                                    Primero</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?id_categoria=<?php echo $id_categoria; ?>&pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <!-- Mostrar los números de página -->
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="?id_categoria=<?php echo $id_categoria; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Enlace a la siguiente y última página -->
                        <?php if ($pagina_actual < $total_paginas): ?>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?id_categoria=<?php echo $id_categoria; ?>&pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?id_categoria=<?php echo $id_categoria; ?>&pagina=<?php echo $total_paginas; ?>">Último
                                    &raquo;</a>
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