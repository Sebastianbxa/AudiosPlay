<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AudiosPlay - Documentación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        header {
            background-color: #2196f3;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        nav {
            width: 250px;
            background: #f5f5f5;
            padding: 1rem;
            border-right: 1px solid #ddd;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 0;
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        nav ul li:last-child {
            border-bottom: none;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: bold;
        }

        nav ul li a:hover {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        nav ul li a.active {
            background-color: #1976d2;
            color: white;
        }

        .content {
            flex: 1;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            color: #333;
            margin-bottom: 1rem;
        }

        .code {
            background: #333;
            color: #fff;
            padding: 1rem;
            border-radius: 4px;
            font-family: monospace;
            overflow-x: auto;
        }

        .note {
            background: #fff3cd;
            color: #856404;
            padding: 1rem;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            margin-top: 1rem;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            color: #777;
        }

        /* Media Query para pantallas menores de 480px */
        @media (max-width: 480px) {
            header {
                font-size: 1rem; /* Reduce el tamaño del título */
            }

            nav ul li a {
                font-size: 0.9rem; /* Reduce el tamaño de los enlaces */
                padding: 0.5rem;
            }

            .content {
                padding: 0.5rem;
            }

            .feature-list li {
                font-size: 0.9rem; /* Reduce el texto de las listas */
            }
        }
    </style>

</head>
<body>
    <header>
        <h1>AudiosPlay - Documentación</h1>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="/documentation" class="active">Introducción</a></li>
                <li><a href="/documentation/install">Instalación</a></li>
            </ul>
        </nav>
        <main class="content">
            <section id="installation">
                <h2>Requisitos</h2>
                <ul>
                    <li><strong>Xampp 8.2.12</strong></li>
                    <li><strong>PHP 8.1</strong> (Incluido en Xampp)</li>
                    <li><strong>MySQL</strong> (Incluido en Xampp)</li>
                    <li><strong>Node.js 17.9.1</strong></li>
                    <li><strong>Composer</strong></li>
                </ul>
                <h2>Instrucciones</h2>
                <ol>
                    <li>Clonar o descargar el repositorio del proyecto.</li>
                    <li>Establecer las variables de entorno copiando <code>.env.example</code> como <code>.env</code>, configurar las credenciales de la base de datos y generar las claves de reCAPTCHA.</li>
                    <li>Instalar dependencias ejecutando:
                        <div class="code">
                            composer install<br>
                            composer require laravel/legacy-factories<br>
                            npm install<br>
                            php artisan key:generate<br>
                            npm run build<br>
                            php artisan migrate:fresh --seed
                        </div>
                    </li>
                    <li>Levantar el servidor con <code>php artisan serve</code>.</li>
                </ol>
            </section>

            <section id="admin-panel">
                <h1>Panel Administrativo</h1>
                <p><strong>Credenciales:</strong></p>
                <ul>
                    <li><strong>Correo:</strong> admin@example.com</li>
                    <li><strong>Contraseña:</strong> AudiosPlay12*</li>
                </ul>
                <img src="https://audiosplay.com/images/screenshot/login.png" alt="Login" style="max-width: 100%; margin-top: 1rem;">
                <img src="https://audiosplay.com/images/screenshot/panel.png" alt="Panel" style="max-width: 100%; margin-top: 1rem;">
            </section>

            <section id="site-portal">
                <h1>Sitio Web / Portal</h1>
                <img src="https://audiosplay.com/images/screenshot/portal.png" alt="Portal" style="max-width: 100%; margin-top: 1rem;">
                <img src="https://audiosplay.com/images/screenshot/audiolibros.png" alt="Audiolibros" style="max-width: 100%; margin-top: 1rem;">
            </section>

            <section id="audio-player">
                <h1>Reproductor</h1>
                <img src="https://audiosplay.com/images/screenshot/audiosplay_detalles.png" alt="Reproductor" style="max-width: 100%; margin-top: 1rem;">
                <img src="https://audiosplay.com/images/screenshot/audiosplay_detalles_2.png" alt="Reproductor 2" style="max-width: 100%; margin-top: 1rem;">
            </section>

            <section id="favorites">
                <h1>Favoritos</h1>
                <img src="https://audiosplay.com/images/screenshot/favoritos.png" alt="Favoritos" style="max-width: 100%; margin-top: 1rem;">
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2025 AudiosPlay. Todos los derechos reservados.</p>
    </footer>
</body>
<script>
    // Obtiene la URL actual
    const currentPath = window.location.pathname;

    // Selecciona todos los enlaces del menú
    const navLinks = document.querySelectorAll('nav ul li a');

    // Itera sobre los enlaces y ajusta la clase 'active' según la URL
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
</script>
</html>
