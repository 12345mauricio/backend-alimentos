<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIstema de Alimentos - Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-shield-check text-success fs-3"></i> 
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item active">
                <a href="{{ url('/dashboard') }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            </li>
            <li class="sidebar-item">
                <a href="#"><i class="bi bi-box-seam"></i> Gestión Productos</a>
            </li>
            <li class="sidebar-item">
                <a href="#"><i class="bi bi-tags"></i> Gestión de Lotes</a>
            </li>
            <li class="sidebar-item">
                <a href="#"><i class="bi bi-bar-chart-steps"></i> Trazabilidad</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="text-warning"><i class="bi bi-exclamation-triangle"></i> Alertas Críticas</a>
            </li>
            <li class="sidebar-item" style="margin-top: 120px;">
                <form action="{{ url('/logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="document.getElementById('logout-form').submit();" class="text-danger-emphasis">
                        <i class="bi bi-box-arrow-left text-danger"></i> Cerrar Sesión
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="search-container">
                <i class="bi bi-search"></i>
                <input type="text" class="search-bar" placeholder="Buscar productos, lotes o reportes...">
            </div>
            <div class="d-flex align-items-center gap-4">
                <i class="bi bi-bell text-secondary fs-5"></i>
                <div class="text-end">
                    <span class="fw-bold d-block text-dark small" style="line-height: 1;">{{ Auth::user()->name }}</span>
                    <small class="text-muted small">{{ ucfirst(Auth::user()->rol) }}</small>
                </div>
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    AD
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Resumen General</h2>
                <p class="text-muted mb-0">Bienvenido al panel de control de SI-GESTA</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="kpi-card">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold d-block mb-1">Productos Registrados</span>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalProductos }}</h3>
                    </div>
                    <div class="kpi-icon bg-icon-prod"><i class="bi bi-box-seam"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold d-block mb-1">Próximos a Vencer</span>
                        <h3 class="fw-bold text-warning mb-0">{{ $lotesAlertas }}</h3>
                    </div>
                    <div class="kpi-icon bg-icon-warn"><i class="bi bi-clock-history"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold d-block mb-1">Lotes Vencidos</span>
                        <h3 class="fw-bold text-danger mb-0">{{ $lotesVencidos }}</h3>
                    </div>
                    <div class="kpi-icon bg-icon-danger"><i class="bi bi-trash3"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold d-block mb-1">Stock en Almacén</span>
                        <h3 class="fw-bold text-primary mb-0">{{ $stockTotal }}</h3>
                    </div>
                    <div class="kpi-icon bg-icon-stock"><i class="bi bi-arrow-left-right"></i></div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <div class="card card-custom p-4">
                    <h5 class="fw-bold text-dark mb-4">Lotes en Almacén</h5>
                    <table class="table table-borderless align-middle m-0">
                        <thead>
                            <tr class="text-muted small border-bottom">
                                <th class="pb-3">CÓD. LOTE</th>
                                <th class="pb-3">PRODUCTO</th>
                                <th class="pb-3">CATEGORÍA</th>
                                <th class="pb-3">CANTIDAD</th>
                                <th class="pb-3">ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lotes as $lote)
                            <tr class="border-bottom" style="height: 60px;">
                                <td class="fw-semibold text-dark">#{{ $lote->codigo_lote }}</td>
                                <td class="text-secondary">{{ $lote->producto_nombre }}</td>
                                <td class="text-secondary">{{ $lote->categoria }}</td>
                                <td class="text-secondary">{{ $lote->cantidad }} uds</td>
                                <td>
                                    @if($lote->estado == 'vencido')
                                        <span class="badge px-3 py-2 bg-danger-subtle text-danger border-0">Vencido</span>
                                    @elseif($lote->estado == 'por_vencer')
                                        <span class="badge px-3 py-2 bg-warning-subtle text-warning border-0">Por Vencer</span>
                                    @else
                                        <span class="badge px-3 py-2 bg-success-subtle text-success border-0">Activo</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-4">
                    <h5 class="fw-bold text-dark mb-4">Inventario por Categoría</h5>
                    <div class="d-flex flex-column gap-3">
                        @forelse($categorias as $cat)
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-medium text-secondary small">{{ $cat->categoria }}</span>
                                <span class="fw-bold text-dark small">{{ $cat->total_stock }} uds</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small m-0">No hay categorías registradas.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>