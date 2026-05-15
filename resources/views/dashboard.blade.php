<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Alimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🍎 Trazabilidad de Alimentos</span>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Panel de Control de Lotes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Cód. Lote</th>
                                    <th>Producto</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Estado (Semáforo)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lotes as $lote)
                                <tr>
                                    <td><strong>{{ $lote->codigo_lote }}</strong></td>
                                    <td>{{ $lote->producto_nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lote->fecha_vencimiento)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($lote->estado == 'vencido')
                                            <span class="badge bg-danger">VENCIDO</span>
                                        @elseif($lote->estado == 'por_vencer')
                                            <span class="badge bg-warning text-dark">POR VENCER</span>
                                        @else
                                            <span class="badge bg-success">ÓPTIMO</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>