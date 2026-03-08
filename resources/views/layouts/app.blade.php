<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرض التوظيف</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --dark: #1f2937;
            --light: #f9fafb;
            --gray: #6b7280;
        }
        body { font-family: 'Cairo', sans-serif; background: var(--light); }
        .navbar { background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; color: var(--primary) !important; }
        .btn-primary { background: var(--primary); border: none; padding: 10px 24px; border-radius: 8px; }
        .btn-primary:hover { background: var(--primary-dark); }
        .hero { background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%); padding: 80px 0; }
        .hero h1 { font-size: 3rem; font-weight: 700; }
        .card { border: none; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .card:hover { transform: translateY(-4px); }
        .card-header { background: white; border-bottom: 1px solid #e5e7eb; font-weight: 600; }
        .event-card { overflow: hidden; }
        .event-card .card-img-top { height: 160px; object-fit: cover; }
        .badge-custom { background: rgba(79, 70, 229, 0.1); color: var(--primary); padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; }
        .stat-card { text-align: center; padding: 24px; }
        .stat-card i { font-size: 2.5rem; color: var(--primary); margin-bottom: 12px; }
        .stat-card h3 { font-size: 2rem; font-weight: 700; margin: 0; }
        .table-custom { background: white; border-radius: 12px; overflow: hidden; }
        .table-custom th { background: var(--light); font-weight: 600; padding: 16px; }
        .table-custom td { padding: 16px; vertical-align: middle; }
        .form-control { border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; }
        .form-control:focus { border-color: var(--primary); box-shadow: none; }
        .sidebar { background: white; min-height: 100vh; box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
        .sidebar-link { padding: 14px 20px; color: var(--gray); text-decoration: none; display: flex; align-items: center; gap: 12px; border-radius: 8px; margin: 4px 12px; transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: var(--primary); color: white; }
        .sidebar-link i { width: 20px; }
        .dropdown-menu { border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border-radius: 12px; }
        .feature-icon { width: 60px; height: 60px; background: rgba(79, 70, 229, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary); }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-briefcase ms-2"></i>معرض التوظيف
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="#events">الفعاليات</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">عن النظام</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="/login" class="btn btn-outline-primary">تسجيل دخول</a>
                <a href="/register" class="btn btn-primary">حساب جديد</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
@yield('hero')

<!-- Main Content -->
<div class="container py-5">
    @yield('content')
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">© 2026 معرض التوظيف. جميع الحقوق محفوظة</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
