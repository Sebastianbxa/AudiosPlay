# AudiosPlay
Es una plataforma de audiolibros desarrollada en **Laravel**, diseñada para gestionar usuarios y contenido. Incluye un sistema de membresías para ofrecer acceso personalizado a los recursos disponibles.


> Docuementación completa: [documentation.audiosplay.com](https://documentation.audiosplay.com)


## 🛠️   Instalación  

### Requisitos 
Tener instalado las siguientes herramientas: 
- **Xampp 8.2.12**
- **PHP 8.1**  (Viene incluido en xampp)  
- **MySQL**  (Viene incluido en xampp) 
- **Node.js 17.9.1**  
- **Composer**  

---

### Instrucciones  
1. **Clonar o descargar** el repositorio del proyecto.  
2. **Establecer variables de entorno.**  
   - Copiar `.env.example` y renombrar como `.env`
   - Crear una base de datos en phpmyadmin
   - Escribir las credenciales de la base de datos en el archivos `.env` en la seccion **Conexion_BD**, por defecto el DB_USERNAME es root y DB_PASSWORD se dejan en blanco.  
3. **Instalar Dependencias**  
   Abra una terminal en el directorio raíz del proyecto y ejecute:  
   ```bash
   composer install
   composer require laravel/legacy-factories
   npm install
   php artisan key:generate
   npm run build
   php artisan migrate:fresh --seed
4. **Levantar servidor**  
   ```bash
   php artisan serve
4. **Crear usuario**
Se ha implementa recaptcha v3 para no permirir el registro de boots, y se realiza el siguiente procedimiento: .
    - Realizar el registro en https://www.google.com/recaptcha/admin
    - En la seccion dominios se crean 2 llamados localhost y 127.0.0.1
    - Al terminar el registro se generan 2 claves que se ponen en la sección de **Recaptcha_Google** en el archivo `.env`  

---
## 🚀 Credenciales

### Panel Administrativo
**Credenciales:**  
- **Correo:** `admin@example.com`  
- **Contraseña:** `AudiosPlay12*`  

![Login](<https://audiosplay.com/images/screenshot/login.png>)
![Panel](<https://audiosplay.com/images/screenshot/panel.png>)

### Sitio web / Portal
![Portal](<https://audiosplay.com/images/screenshot/portal.png>)
![Portal_eccion_2](<https://audiosplay.com/images/screenshot/portal_seccion_2.png>)
![Audiolibros](<https://audiosplay.com/images/screenshot/audiolibros.png>)

### Sitio web / Reproductor
![Reproductor](<https://audiosplay.com/images/screenshot/audiosplay_detalles.png>)
![Reproductor_2](<https://audiosplay.com/images/screenshot/audiosplay_detalles_2.png>)

### Sitio web / Favoritos
![Favoritos](<https://audiosplay.com/images/screenshot/favoritos.png>)


