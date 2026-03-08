@extends('layouts.app')

@section('hero')
<div class="hero text-white">
    <div class="container text-center">
        <h1 class="mb-4">🎯 ابحث عن وظيفتك الآن</h1>
        <p class="lead mb-4">شارك في أفضل معارض التوظيف وتواصل مع كبرى الشركات</p>
        <a href="#events" class="btn btn-light btn-lg px-5">تصفح الفعاليات</a>
    </div>
</div>
@endsection

@section('content')
<!-- Stats -->
<div class="row mb-5">
    <div class="col-md-4">
        <div class="card stat-card">
            <i class="fas fa-building"></i>
            <h3>{{ $events->sum(fn($e) => $e->companies->count()) }}</h3>
            <p class="text-muted">شركة مشاركة</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <i class="fas fa-users"></i>
            <h3>{{ $events->sum(fn($e) => $e->applicants->count()) }}</h3>
            <p class="text-muted">متقدم</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3>{{ $events->count() }}</h3>
            <p class="text-muted">فعالية نشطة</p>
        </div>
    </div>
</div>

<!-- Events -->
<h2 class="mb-4" id="events">الفعاليات المتاحة</h2>
<div class="row">
    @forelse($events as $event)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 event-card">
            <div class="card-body">
                <span class="badge-custom mb-2">{{ $event->status === 'active' ? 'نشط' : $event->status }}</span>
                <h4 class="card-title mb-3">{{ $event->name }}</h4>
                <p class="text-muted mb-3">{{ Str::limit($event->description, 80) }}</p>
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div><i class="fas fa-calendar ms-1"></i> {{ $event->event_date }}</div>
                    <div><i class="fas fa-clock ms-1"></i> {{ $event->start_time }}</div>
                </div>
                
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-map-marker-alt text-muted"></i>
                    <span>{{ $event->location }}</span>
                </div>
                
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-primary rounded-pill">
                        <i class="fas fa-building ms-1"></i> {{ $event->companies->count() }} شركات
                    </span>
                </div>
                
                @if($event->status === 'active')
                <a href="{{ route('applicant.register', $event->id) }}" class="btn btn-primary w-100">
                    <i class="fas fa-user-plus ms-2"></i> سجل الآن
                </a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-calendar-xmark fa-3x mb-3"></i>
            <h4>لا توجد فعاليات نشطة حالياً</h4>
            <p class="mb-0">تفقد لاحقاً!</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Features -->
<h2 class="mb-4 mt-5" id="about">مميزات النظام</h2>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="feature-icon mx-auto mb-3">
                <i class="fas fa-qrcode"></i>
            </div>
            <h5>QR Code</h5>
            <p class="text-muted">كل متقدم يحصل على QR Code فريد للدخول</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="feature-icon mx-auto mb-3">
                <i class="fas fa-clock"></i>
            </div>
            <h5>توزيع الوقت</h5>
            <p class="text-muted">نظام حجز مواعيد الدخول لتجنب الزحام</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="feature-icon mx-auto mb-3">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h5>إحصائيات</h5>
            <p class="text-muted">لوحة تحكم متكاملة للشركات والإدارة</p>
        </div>
    </div>
</div>
@endsection
