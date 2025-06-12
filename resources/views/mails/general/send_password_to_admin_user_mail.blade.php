<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a {{ config('app.name') }}</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .welcome-message {
            background-color: #E8F5E9;
            border-left: 4px solid #4CAF50;
            padding: 10px;
            margin: 10px 0;
        }
        .credentials {
            background-color: #E3F2FD;
            border-left: 4px solid #2196F3;
            padding: 10px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>¡Bienvenido a {{ config('app.name') }}!</h1>
        </div>

        <div class="content">
            <p>Hola {{ $user->name }} {{ $user->last_name }},</p>

            <div class="welcome-message">
                <p>Nos complace darte la bienvenida a nuestra plataforma. Tu registro ha sido exitoso y ya puedes comenzar a utilizar nuestros servicios.</p>
            </div>

            <div class="credentials">
                <p><strong>Tus credenciales de acceso:</strong></p>
                <ul>
                    <li><strong>Rol:</strong> {{ $user->getRoleNames() }}</li>
                    <li><strong>Correo electrónico:</strong> {{ $user->email }}</li>
                    <li><strong>Contraseña temporal:</strong> {{ $passwordTextPlain }}</li>
                </ul>
                <p>Por seguridad, te recomendamos cambiar tu contraseña después de tu primer acceso.</p>
            </div>

            <p>Para comenzar, ingresa a nuestra plataforma a través de <a href="{{ $loginUrl }}">este enlace</a>.</p>

            <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactar a nuestro equipo de soporte.</p>

            <p>¡Gracias por unirte a nosotros!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
