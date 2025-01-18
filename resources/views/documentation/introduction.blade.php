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
            font-size: 1.8rem;
        }

        .highlight {
            color: #1976d2;
            font-weight: bold;
        }

        .feature-list {
            margin: 1rem 0;
            padding-left: 1rem;
        }

        .feature-list li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
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
            <section id="getting-started">
                <p>
                    <span class="highlight">AudiosPlay</span> es una plataforma moderna para los amantes de los audiolibros y creadores de contenido. 
                    Diseñada sobre el framework Laravel, ofrece una experiencia robusta para gestionar usuarios y contenido digital.
                </p>
                <p>
                    Con una interfaz intuitiva y herramientas avanzadas, AudiosPlay garantiza facilidad de uso y acceso personalizado a los recursos disponibles. ¡Explora el futuro de los audiolibros hoy!
                </p>
                <ul class="feature-list">
                    <li>Sistema de membresías para acceso exclusivo.</li>
                    <li>Seguridad mejorada con Google reCAPTCHA v3.</li>
                    <li>Interfaz atractiva y totalmente responsiva.</li>
                    <li>Gestión eficiente de favoritos y listas de reproducción.</li>
                </ul>
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
