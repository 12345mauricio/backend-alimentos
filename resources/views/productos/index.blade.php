<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - SI-GESTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-shield-check text-success fs-3"></i> 
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ url('/dashboard') }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            </li>
            <li class="sidebar-item active">
                <a href="{{ route('productos.index') }}"><i class="bi bi-box-seam"></i> Gestión Productos</a>
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
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Productos</h2>
                <p class="text-muted mb-0">Control e inocuidad garantizado por lotes y alertas inteligentes FEFO</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 shadow-sm border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark m-0">Catálogo General de Productos</h5>
                
                <div class="d-flex gap-3">
                    <form action="{{ route('productos.index') }}" method="GET" class="search-container m-0" style="position: relative;">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar productos..." value="{{ $buscar }}" style="padding-left: 35px; border-radius: 8px;">
                        <i class="bi bi-search" style="position: absolute; left: 12px; top: 10px; color: #6c757d;"></i>
                    </form>
                    
                    <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#modalCrearProducto" style="border-radius: 8px; background-color: #198754;">
                        <i class="bi bi-plus-lg me-2"></i> Agregar Producto
                    </button>
                </div>
            </div>

            <table class="table table-borderless align-middle m-0">
                <thead>
                    <tr class="text-muted small border-bottom">
                        <th class="pb-3">ID</th>
                        <th class="pb-3">NOMBRE</th>
                        <th class="pb-3">CATEGORÍA</th>
                        <th class="pb-3">U. MEDIDA</th>
                        <th class="pb-3">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                    <tr class="border-bottom" style="height: 60px;">
                        <td class="fw-semibold text-dark">{{ $producto->id }}</td>
                        <td class="text-dark fw-medium">{{ $producto->nombre }}</td>
                        <td class="text-secondary"><span class="badge bg-light text-dark border px-3 py-2">{{ $producto->categoria }}</span></td>
                        <td class="text-secondary">{{ $producto->unidad_medida }}</td>
                        <td class="text-secondary text-truncate" style="max-width: 250px;">{{ $producto->descripcion ?? 'Sin descripción' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No se encontraron productos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalCrearProducto" tabindex="-1" aria-labelledby="modalCrearProductoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2" style="border-radius: 16px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-dark" id="modalCrearProductoLabel">Crear Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small">Nombre del Producto *</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Yogurt, Jamón..." required style="border-radius: 8px;">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">Categoría</label>
                                <select name="categoria" class="form-select" style="border-radius: 8px;">
                                    <option value="Lácteos">Lácteos</option>
                                    <option value="Cárnicos">Cárnicos</option>
                                    <option value="Granos">Granos</option>
                                    <option value="Bebidas">Bebidas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">Unidad de Medida</label>
                                <select name="unidad_medida" class="form-select" style="border-radius: 8px;">
                                    <option value="Unidades">Unidades</option>
                                    <option value="Litros">Litros</option>
                                    <option value="Kg">Kg</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold text-secondary small">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalle sanitario, origen del insumo..." style="border-radius: 8px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3">
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold" style="border-radius: 8px; background-color: #198754;">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>