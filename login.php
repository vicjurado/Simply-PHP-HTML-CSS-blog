<!-- HEADER.PHP -->
<?php include('includes/header.php'); ?>
<!-- // HEADER.PHP -->

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php
            // Agregar depuración para verificar si la solicitud POST está siendo procesada
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Obtiene los valores del formulario y los sanitiza
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = $_POST['password'];

                // Consulta con parámetros preparados
                $sql = "SELECT id_usuario, nickname_usuario, password_usuario FROM usuario WHERE email_usuario = :email";
                $resultado = $conn->prepare($sql);
                $resultado->bindParam(':email', $email, PDO::PARAM_STR);
                $resultado->execute();

                // Si encontramos el usuario
                if ($resultado->rowCount() == 1) {
                    $row = $resultado->fetch(PDO::FETCH_ASSOC);  // Usar PDO::FETCH_ASSOC para un arreglo asociativo
            
                    // Verificar la contraseña (con hash)
                    if ($password === $row['password_usuario']) {
                        // Si la contraseña es correcta, iniciar sesión
                        $_SESSION['id_usuario'] = $row['id_usuario'];
                        $_SESSION['nickname_usuario'] = $row['nickname_usuario'];

                        // Redirigir a index.php
                        header("Location: index.php");
                        exit;  // Detener la ejecución del script para asegurar que la redirección ocurra
                    } else {
                        $error = "Contraseña incorrecta.";
                        echo "Error: Contraseña incorrecta <br>";
                    }
                } else {
                    $error = "Correo no registrado.";
                    echo "Error: Correo no registrado <br>";
                }
            }
            ?>

            <div class="card">
                <div class="card-header text-center">
                    <h4>Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
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