-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-12-2024 a las 12:08:02
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog_victor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'PHP', 'PHP es un lenguaje de programación para desarrollar aplicaciones y crear sitios web que conquista cada día más seguidores. Fácil de usar y en constant'),
(2, 'CSS', 'CSS es un lenguaje informático especializado en definir y cohesionar la presentación de un documento escrito en un lenguaje de marcado como HTML o XML'),
(3, 'HTML', 'HTML son las siglas en inglés de HyperText Markup Lenguage, que significa Lenguaje de Marcado de HiperTexto. Se llama así al lenguaje de programación ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

DROP TABLE IF EXISTS `entrada`;
CREATE TABLE IF NOT EXISTS `entrada` (
  `id_entrada` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `titulo_entrada` varchar(100) NOT NULL,
  `contenido_entrada` text NOT NULL,
  `fecha_publicacion_entrada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_usuario_entrada` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_usuario`, `titulo_entrada`, `contenido_entrada`, `fecha_publicacion_entrada`) VALUES
(1, 1, 'Introducción a PHP: Qué es y para qué sirve', 'PHP (Hypertext Preprocessor) es un lenguaje de programación diseñado para la creación de páginas web dinámicas. Es ampliamente utilizado en aplicaciones web como sistemas de gestión de contenido (CMS) y comercio electrónico. PHP se integra perfectamente con HTML y bases de datos como MySQL, permitiendo desarrollar proyectos interactivos y personalizados. Es de código abierto, fácil de aprender y compatible con múltiples plataformas.', '2024-12-16 12:31:46'),
(2, 1, 'Ventajas de usar PHP en Desarrollo Web', 'PHP es un lenguaje versátil y eficiente, ideal para proyectos de todos los tamaños. Sus principales ventajas incluyen ser de código abierto, gratuito y con soporte en casi todos los servidores web. Posee una comunidad activa que garantiza una amplia documentación y recursos. Además, su flexibilidad lo hace compatible con frameworks modernos como Laravel y bases de datos como MySQL, PostgreSQL o SQLite, optimizando el tiempo de desarrollo.', '2024-12-16 12:32:38'),
(3, 1, 'Cómo configurar un Entorno de Desarrollo para PHP', 'Configurar un entorno de desarrollo PHP requiere instalar un servidor web (como Apache o Nginx), el intérprete de PHP y un sistema de bases de datos (como MySQL). Herramientas como XAMPP, WAMP o MAMP ofrecen soluciones preconfiguradas, facilitando el proceso. Estas herramientas incluyen todo lo necesario para comenzar a programar, ejecutar y probar aplicaciones PHP localmente sin complicaciones técnicas.', '2024-12-16 12:33:46'),
(4, 1, 'Las variables en PHP: Tipos y Buenas Prácticas', 'En PHP, las variables son dinámicas y no requieren declarar su tipo. Se identifican con el símbolo $ seguido de un nombre. Los tipos de datos comunes incluyen enteros, cadenas, arrays y objetos. Usar nombres descriptivos y organizados mejora la legibilidad. Además, adoptar estándares como CamelCase o snake_case y comentar adecuadamente el código asegura un mantenimiento más sencillo y evita errores.', '2024-12-16 12:34:25'),
(5, 1, 'Manejo de formularios en PHP: Cómo capturar y validar datos', 'PHP facilita la captura de datos de formularios HTML mediante las superglobales $_POST y $_GET. Sin embargo, procesar datos sin validarlos puede poner en riesgo la seguridad. Se recomienda utilizar funciones como filter_var para validar correos electrónicos o números, y htmlspecialchars para prevenir ataques XSS. Una validación adecuada garantiza la integridad y seguridad de tu aplicación web.', '2024-12-16 12:35:17'),
(6, 1, 'Conexión a Bases de Datos con PHP y MySQL', 'Conectar PHP a MySQL es fundamental para gestionar datos. Usar PDO o mysqli permite ejecutar consultas de manera eficiente y segura. PDO es especialmente útil por su soporte para múltiples motores de bases de datos. Además, usar sentencias preparadas evita vulnerabilidades como inyección SQL, garantizando que los datos de los usuarios sean procesados correctamente y sin riesgos de seguridad.', '2024-12-16 12:35:38'),
(7, 1, 'Frameworks Populares de PHP: Laravel, Symfony y CodeIgniter', 'Los frameworks PHP optimizan el desarrollo web al proporcionar estructuras predefinidas. Laravel es conocido por su simplicidad, integración con herramientas como Eloquent ORM y su sistema de plantillas Blade. Symfony, más robusto, es ideal para proyectos complejos, y CodeIgniter destaca por su ligereza y facilidad de uso. Estos frameworks reducen tiempos de desarrollo y mejoran la calidad del código.', '2024-12-16 12:36:03'),
(8, 1, 'Buenas prácticas para escribir código en PHP', 'Mantener un código PHP limpio es crucial para su mantenimiento. Sigue estándares como PSR-1 y PSR-2 para mejorar la legibilidad. Divide el código en funciones o clases reutilizables, evita redundancias y comenta detalladamente las partes complejas. Además, emplea control de versiones como Git y herramientas de análisis estático para identificar posibles errores y mejorar la calidad del desarrollo.', '2024-12-16 12:36:25'),
(9, 1, 'Seguridad en PHP: Protegiendo tu Aplicación Web', 'La seguridad en PHP implica prevenir ataques comunes como inyección SQL y XSS. Usa siempre sentencias preparadas para manejar bases de datos, valida entradas del usuario y utiliza funciones como htmlspecialchars para evitar la ejecución de scripts maliciosos. Implementar medidas como tokens CSRF y configurar adecuadamente el archivo php.ini reduce significativamente los riesgos de vulnerabilidad.', '2024-12-16 12:36:39'),
(10, 1, 'Cómo optimizar el rendimiento de PHP en Aplicaciones Web', 'Optimizar PHP mejora la velocidad y experiencia del usuario. Implementa sistemas de caché como OPCache para reducir la carga del servidor. Minimiza las consultas a la base de datos, usa frameworks ligeros y comprime archivos CSS y JavaScript. Además, monitorear el rendimiento con herramientas como New Relic o Blackfire ayuda a identificar cuellos de botella y optimizar cada aspecto de tu aplicación.', '2024-12-16 12:36:54'),
(11, 1, 'Introducción a CSS: Cómo embellecer tu sitio web', 'CSS (Cascading Style Sheets) es un lenguaje utilizado para diseñar y estilizar sitios web. Gracias a CSS, puedes controlar el diseño, colores, tipografía y espaciado de los elementos HTML. Se pueden aplicar estilos de tres formas: en línea, en el encabezado de la página o en un archivo externo. CSS permite separar el contenido de la presentación, mejorando la organización y el mantenimiento de los proyectos. Su compatibilidad con animaciones y efectos visuales modernos lo convierte en una herramienta imprescindible para el desarrollo web actual.', '2024-12-16 12:53:20'),
(12, 1, 'Selectores en CSS: Cómo aplicar estilos de manera eficiente', 'Los selectores en CSS son fundamentales para aplicar estilos a elementos específicos de un documento HTML. Desde selectores básicos como etiquetas (div, p) hasta avanzados como selectores de atributos o pseudo-clases (:hover, :nth-child), cada uno cumple un propósito único. Usar selectores precisos mejora el rendimiento del CSS y evita conflictos en proyectos grandes. Aprender a combinarlos y priorizarlos con especificidad es clave para dominar el diseño eficiente y escalable.', '2024-12-16 12:53:50'),
(13, 1, 'Diseño Responsive con CSS: Haciendo tu sitio web adaptable', 'El diseño responsive asegura que los sitios web se adapten a diferentes tamaños de pantalla, desde computadoras hasta móviles. CSS ofrece herramientas como media queries (@media) para aplicar estilos específicos según el ancho del dispositivo. Además, técnicas como el uso de unidades relativas (em, % o vh/vw) y flexbox o grid facilitan la creación de layouts fluidos. La prioridad es garantizar una experiencia de usuario consistente, independientemente del dispositivo utilizado.', '2024-12-16 12:54:08'),
(14, 1, 'CSS Grid: La revolución en el diseño de layouts', 'CSS Grid es una de las herramientas más potentes para construir layouts web. Permite diseñar páginas dividiendo el espacio en filas y columnas, controlando fácilmente la ubicación de los elementos. Su sintaxis, basada en propiedades como grid-template-rows y grid-template-columns, ofrece un control total sobre la estructura. Grid facilita la creación de diseños complejos, desde galerías de imágenes hasta layouts de aplicaciones web, con un enfoque intuitivo y flexible.', '2024-12-16 12:54:42'),
(15, 1, 'Flexbox en CSS: Alineación y distribución simplificadas', 'Flexbox es un modelo de diseño que facilita la alineación y distribución de elementos dentro de un contenedor. Propiedades como justify-content, align-items y flex-wrap permiten controlar la disposición tanto horizontal como vertical de los elementos, adaptándolos a diferentes tamaños de pantalla. Su flexibilidad lo hace ideal para crear menús, barras de navegación y componentes dinámicos. Flexbox elimina muchos de los problemas del diseño tradicional con floats y posicionamiento absoluto.', '2024-12-16 12:54:59'),
(16, 1, 'Animaciones en CSS: Dando vida a tus páginas web', 'CSS permite crear animaciones fluidas y dinámicas sin necesidad de JavaScript. Con la propiedad @keyframes, puedes definir movimientos, transiciones de color, rotaciones y mucho más. Propiedades como transition y animation te permiten controlar la duración, la aceleración y la repetición de los efectos. Las animaciones en CSS no solo mejoran la estética de tu sitio, sino que también pueden mejorar la experiencia del usuario al destacar elementos clave.', '2024-12-16 12:55:28'),
(17, 1, 'Variables en CSS: Mejorando la reusabilidad del código', 'Las variables en CSS (--nombre-variable) son una funcionalidad poderosa que permite almacenar valores reutilizables como colores, tamaños o márgenes. Se definen en el archivo CSS y se aplican con la función var(). Este enfoque mejora la consistencia del diseño y facilita los cambios globales. Por ejemplo, modificar una paleta de colores en un sitio web se vuelve mucho más eficiente al actualizar solo las variables relacionadas, ahorrando tiempo y esfuerzo en proyectos grandes.', '2024-12-16 12:55:46'),
(18, 1, 'Sombras y gradientes en CSS: Efectos modernos para tu diseño', 'CSS permite crear sombras y gradientes para añadir profundidad y atractivo visual a tus diseños. Con box-shadow y text-shadow, puedes aplicar sombras a elementos y texto, ajustando propiedades como el desenfoque y la dirección. Por otro lado, los gradientes (linear-gradient o radial-gradient) son útiles para crear fondos elegantes y coloridos. Estas herramientas modernas no solo mejoran la estética, sino que también aportan un toque profesional a cualquier proyecto.', '2024-12-16 12:56:05'),
(19, 1, 'Sistemas de colores en CSS: Cómo elegir y usar la paleta perfecta', 'CSS admite diferentes sistemas de colores como hexadecimal, RGB, HSL y nombres predefinidos. Cada sistema tiene ventajas específicas: hexadecimales son compactos, mientras que HSL permite ajustes intuitivos de tono, saturación y luminosidad. Además, puedes implementar transparencias con valores RGBA o HSLA. Entender cómo combinar estos sistemas y usarlos en armonía con el diseño asegura que tu sitio web sea atractivo y accesible para todos los usuarios.', '2024-12-16 12:56:24'),
(20, 1, 'Herramientas modernas para escribir CSS más eficiente', 'Escribir CSS puede optimizarse con herramientas modernas como preprocesadores (Sass, Less) y frameworks (Bootstrap, Tailwind CSS). Sass añade características como funciones, mixins y anidación, mientras que frameworks proporcionan estilos predefinidos para componentes comunes. Además, usar herramientas como PostCSS para automatizar tareas y linters como Stylelint asegura que tu código sea limpio, eficiente y compatible con los estándares modernos.', '2024-12-16 12:56:45'),
(21, 1, 'Introducción a HTML: La base de la web', 'HTML (HyperText Markup Language) es el lenguaje estándar para estructurar contenido en la web. Esencialmente, actúa como el esqueleto de una página web, organizando elementos como texto, imágenes, videos y enlaces. HTML utiliza etiquetas como &lt;p&gt; para párrafos o &lt;a&gt; para enlaces, y cada una tiene atributos que permiten personalizar su comportamiento. Aprender HTML es el primer paso para entender cómo funcionan los sitios web y cómo interactúan con los navegadores.', '2024-12-16 12:58:49'),
(22, 1, 'Estructura básica de un documento HTML', 'Todo documento HTML comienza con la declaración &lt;!DOCTYPE html&gt;, que indica al navegador el estándar de HTML a seguir. Luego, incluye etiquetas principales como &lt;html&gt;, &lt;head&gt; y &lt;body&gt;. El &lt;head&gt; contiene metadatos, como el título de la página y enlaces a hojas de estilo, mientras que el &lt;body&gt; contiene el contenido visible para los usuarios. Conocer esta estructura es fundamental para desarrollar páginas web correctamente organizadas.', '2024-12-16 12:59:11'),
(23, 1, 'Etiquetas esenciales en HTML: Una guía completa', 'HTML cuenta con etiquetas clave como &lt;h1&gt; a &lt;h6&gt; para encabezados, &lt;p&gt; para párrafos, &lt;img&gt; para imágenes y &lt;a&gt; para enlaces. Otras etiquetas importantes incluyen &lt;ul&gt; y &lt;ol&gt; para listas, &lt;table&gt; para tablas y &lt;form&gt; para formularios. Cada etiqueta tiene un propósito específico y atributos opcionales que permiten personalizar su funcionalidad. Dominar estas etiquetas es crucial para estructurar contenido de manera efectiva y accesible.', '2024-12-16 12:59:54'),
(24, 1, 'Formularios en HTML: Cómo cpturar datos del usuario', 'Los formularios son una parte fundamental de HTML para interactuar con los usuarios. Usando etiquetas como &lt;form&gt;, &lt;input&gt; y &lt;button&gt;, puedes crear campos de texto, botones de envío y selectores. Los formularios admiten tipos específicos como email, password y number para validar datos automáticamente. Atributos como required y placeholder mejoran la experiencia del usuario. Saber cómo estructurar formularios es esencial para recolectar información de manera eficiente y segura.', '2024-12-16 13:00:16'),
(25, 1, 'Multimedia en HTML: Insertando imágenes, videos y audio', 'HTML permite integrar elementos multimedia de forma sencilla. La etiqueta &lt;img&gt; es utilizada para insertar imágenes, mientras que &lt;video&gt; y &lt;audio&gt; permiten añadir contenido audiovisual. Estas etiquetas soportan atributos como controls, autoplay y loop, ofreciendo opciones de personalización. Integrar multimedia en tus páginas web mejora la experiencia del usuario, haciéndola más interactiva y atractiva, especialmente en aplicaciones modernas.', '2024-12-16 13:00:36'),
(26, 1, 'Navegación en HTML: Cómo crear menús y enlaces', 'La navegación en HTML se logra principalmente con la etiqueta &lt;a&gt;, que permite crear enlaces internos y externos. Para menús, puedes combinar &lt;a&gt; con listas no ordenadas (&lt;ul&gt; y &lt;li&gt;) para estructurar opciones de manera clara. Usar atributos como target=&quot;_blank&quot; para abrir enlaces en nuevas pestañas o rel=&quot;nofollow&quot; para SEO, añade funcionalidad adicional. Diseñar una navegación intuitiva es clave para la experiencia del usuario.', '2024-12-16 13:00:54'),
(27, 1, 'HTML semántico: Mejorando la accesibilidad y el SEO', 'El HTML semántico utiliza etiquetas como &lt;header&gt;, &lt;section&gt;, &lt;article&gt; y &lt;footer&gt; para dar significado a cada parte del contenido. Esto mejora la accesibilidad, ya que los lectores de pantalla pueden interpretar mejor la estructura de la página. Además, los motores de búsqueda como Google valoran el uso de etiquetas semánticas, lo que puede mejorar el posicionamiento SEO. Adoptar buenas prácticas semánticas es crucial para desarrollar sitios web modernos y funcionales.', '2024-12-16 13:01:12'),
(28, 1, 'Atributos globales en HTML: Cómo personalizar cualquier etiqueta', 'Los atributos globales en HTML, como class, id, style y title, pueden aplicarse a casi cualquier etiqueta. Por ejemplo, class e id son esenciales para agregar estilos personalizados o interactividad con JavaScript. title proporciona información adicional al usuario al pasar el cursor. Dominar estos atributos te permite construir páginas más dinámicas y organizadas, facilitando la colaboración con CSS y JavaScript.', '2024-12-16 13:01:38'),
(29, 1, 'Tablas en HTML: Diseñando y Organizando Datos', 'Las tablas en HTML, creadas con la etiqueta &lt;table&gt;, son ideales para mostrar datos estructurados. Las etiquetas &lt;tr&gt; (filas), &lt;th&gt; (encabezados) y &lt;td&gt; (celdas) permiten organizar el contenido de manera lógica. Además, atributos como colspan y rowspan permiten combinar celdas para diseños más complejos. Aunque el diseño de tablas ha evolucionado con CSS, siguen siendo esenciales para mostrar información tabular de manera clara.', '2024-12-16 13:01:59'),
(30, 1, 'Mejoras modernas en HTML5: Nuevas etiquetas y Funcionalidades', 'HTML5 introdujo etiquetas como &lt;canvas&gt; para gráficos, &lt;audio&gt; y &lt;video&gt; para multimedia, y &lt;section&gt; y &lt;article&gt; para contenido semántico. También añadió nuevos atributos, como placeholder en formularios, y API integradas como geolocalización y almacenamiento local (localStorage). Estas mejoras hacen de HTML5 una herramienta poderosa para desarrollar aplicaciones web modernas, interactivas y funcionales sin depender de tecnologías externas.', '2024-12-16 13:02:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_categoria`
--

DROP TABLE IF EXISTS `entrada_categoria`;
CREATE TABLE IF NOT EXISTS `entrada_categoria` (
  `id_entrada_categoria` int NOT NULL AUTO_INCREMENT,
  `id_entrada` int NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id_entrada_categoria`),
  KEY `fk_entrada_categoria` (`id_entrada`),
  KEY `fk_categoria_entrada` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entrada_categoria`
--

INSERT INTO `entrada_categoria` (`id_entrada_categoria`, `id_entrada`, `id_categoria`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(18, 18, 2),
(19, 19, 2),
(20, 20, 2),
(21, 21, 3),
(22, 22, 3),
(23, 23, 3),
(24, 24, 3),
(25, 25, 3),
(26, 26, 3),
(27, 27, 3),
(28, 28, 3),
(29, 29, 3),
(30, 30, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `email_usuario` varchar(50) NOT NULL,
  `nickname_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(255) NOT NULL,
  `fecha_creacion_usuario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_usuario` (`email_usuario`),
  UNIQUE KEY `nickname_usuario` (`nickname_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email_usuario`, `nickname_usuario`, `password_usuario`, `fecha_creacion_usuario`) VALUES
(1, 'admin@prueba.es', 'admin', 'admin', '2024-12-16 12:31:20');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_usuario_entrada` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `entrada_categoria`
--
ALTER TABLE `entrada_categoria`
  ADD CONSTRAINT `fk_categoria_entrada` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_entrada_categoria` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
