<style>
    /* Estilos generales */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    [data-bs-theme="dark"] body {
        background: linear-gradient(135deg, #1a1c20 0%, #2d3436 100%);
    }

    /* Cards y Contenedores */
    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.9);
    }

    [data-bs-theme="dark"] .card {
        background: rgba(45, 52, 54, 0.9);
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* Botones */
    .btn {
        border-radius: 15px;
        padding: 8px 20px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background: linear-gradient(45deg, #2196F3, #03A9F4);
        border: none;
    }

    .btn-success {
        background: linear-gradient(45deg, #4CAF50, #8BC34A);
        border: none;
    }

    .btn-warning {
        background: linear-gradient(45deg, #FF9800, #FFC107);
        border: none;
    }

    .btn-danger {
        background: linear-gradient(45deg, #f44336, #FF5722);
        border: none;
    }

    .btn-info {
        background: linear-gradient(45deg, #00BCD4, #03A9F4);
        border: none;
    }

    /* Tablas */
    .table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        background: linear-gradient(45deg, #2196F3, #03A9F4);
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        border: none;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        transform: scale(1.01);
        background: rgba(33, 150, 243, 0.1);
    }

    /* Badges y Estados */
    .badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 500;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Formularios */
    .form-control, .form-select {
        border-radius: 15px;
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus, .form-select:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.25);
        transform: translateY(-2px);
    }

    /* Modales */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }

    .modal-header {
        background: linear-gradient(45deg, #2196F3, #03A9F4);
        color: white;
        border: none;
        border-radius: 20px 20px 0 0;
    }

    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    /* Navegación */
    .navbar {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    [data-bs-theme="dark"] .navbar {
        background: rgba(45, 52, 54, 0.9);
    }

    /* Paginación */
    .pagination {
        gap: 5px;
    }

    .page-link {
        border-radius: 10px;
        border: none;
        padding: 8px 16px;
        transition: all 0.3s ease;
        background: linear-gradient(45deg, #2196F3, #03A9F4);
        color: white;
    }

    .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
    }

    /* Iconos */
    .fas, .far, .fab {
        transition: all 0.3s ease;
    }

    .btn:hover .fas,
    .btn:hover .far,
    .btn:hover .fab {
        transform: scale(1.2);
    }

    /* Efectos de hover para cards específicas */
    .dashboard-card:hover {
        transform: translateY(-10px) rotate(2deg);
    }

    .product-card:hover {
        transform: translateY(-10px) rotate(-2deg);
    }

    /* Efectos de glassmorphism */
    .glass-effect {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
    }

    [data-bs-theme="dark"] .glass-effect {
        background: rgba(45, 52, 54, 0.2);
    }

    /* Efectos de neomorfismo */
    .neo-effect {
        border-radius: 20px;
        background: #f0f0f0;
        box-shadow: 
            20px 20px 60px #cccccc,
            -20px -20px 60px #ffffff;
    }

    [data-bs-theme="dark"] .neo-effect {
        background: #2d3436;
        box-shadow: 
            20px 20px 60px #1a1c20,
            -20px -20px 60px #404b4d;
    }
</style> 