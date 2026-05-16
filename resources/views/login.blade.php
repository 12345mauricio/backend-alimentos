<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Alimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4 fw-bold text-secondary">🍎 Sistema de Alimentos</h3>
                        <p class="text-muted text-center small mb-4">Introduce tus credenciales para acceder</p>

                        @if($errors->has('login_error'))
                            <div class="alert alert-danger small p-2 text-center">
                                {{ $errors->first('login_error') }}
                            </div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small text-muted fw-bold">Usuario</label>
                                <input type="text" name="username" class="form-content form-control" value="{{ old('username') }}" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small text-muted fw-bold">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold py-2">Ingresar al Sistema</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>