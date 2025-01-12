function validateForm() {
    let valid = true;
    let mensaje = "";

    const name = document.getElementById('name').value;
    const pais = document.getElementById('pais').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;

    if (!name) {
        valid = false;
        mensaje += "Nombre y Apellido es requerido.<br>";
    }

    if (!pais) {
        valid = false;
        mensaje += "Pais es requerido.<br>";
    }

    if (!email) {
        valid = false;
        mensaje += "Correo es requerido.<br>";
    } else if (!validateEmail(email)) {
        valid = false;
        mensaje += "Correo no es válido.<br>";
    }

    if (!password) {
        valid = false;
        mensaje += "Contraseña es requerida.<br>";
    }

    if (!password_confirmation) {
        valid = false;
        mensaje += "Confirmar Contraseña es requerida.<br>";
    } else if (password !== password_confirmation) {
        valid = false;
        mensaje += "Las contraseñas no coinciden.<br>";
    }

    const mensajeElement = document.getElementById('mensaje');
    if (mensajeElement) {
        mensajeElement.innerHTML = mensaje;
    }

    return valid;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function onSubmit(token) {
    if (validateForm()) {
        document.getElementById("registerForm").submit();
    } else {
        grecaptcha.reset();
    }
}