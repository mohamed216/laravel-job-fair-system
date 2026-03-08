@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">لوحة تحكم الأدمن</h2>
    <div>
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ms-2"></i> فعالية جديدة
        </a>
    </div>
</div>

<!-- Stats -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <i class="fas fa-calendar"></i>
            <h3>{{ $stats['total_events'] }}</h3>
            <p class="text-muted">إجمالي الفعاليات</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <i class="fas fa-check-circle text-success"></i>
            <h3>{{ $stats['active_events'] }}</h3>
            <p class="text-muted">فعاليات نشطة</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <i class="fas fa-building text-primary"></i>
            <h3>{{ $stats['total_companies'] }}</h3>
            <p class="text-muted">الشركات</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <i class="fas fa-users text-info"></i>
            <h3>{{ $stats['total_applicants'] }}</h3>
            <p class="text-muted">المتقدمين</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Events -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar ms-2"></i> أحدث الفعاليات</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>التاريخ</th>
                            <th>الشركات</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none">
                                    {{ $event->name }}
                                </a>
                            </td>
                            <td>{{ $event->event_date }}</td>
                            <td><span class="badge bg-primary rounded-pill">{{ $event->companies->count() }}</span></td>
                            <td>
                                @if($event->status === 'active')
                                <span class="badge bg-success">نشط</span>
                                @else
                                <span class="badge bg-secondary">{{ $event->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Applicants -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-users ms-2"></i> أحدث المتقدمين</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الإيميل</th>
                            <th>الفعالية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentApplicants as $applicant)
                        <tr>
                            <td>{{ $applicant->name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->event->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="{{ route('events.create') }}" class="text-decoration-none">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-plus-circle fa-2x text-primary mb-3"></i>
                <h5>إضافة فعالية</h5>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('companies.index') }}" class="text-decoration-none">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-building fa-2x text-success mb-3"></i>
                <h5>إدارة الشركات</h5>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('events.index') }}" class="text-decoration-none">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-list fa-2x text-info mb-3"></i>
                <h5>جميع الفعاليات</h5>
            </div>
        </a>
    </div>
</div>
@endsection
