@extends('layouts.master')
@section('title', 'Dashboard Pegawai')
@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-muted">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
        </div>
    </div>

    <!-- Status Absensi Hari Ini -->
    <div class="row mb-4">
        <div class="col-12">
            @if($todayAttendance)
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Anda Sudah Absen Hari Ini</h5>
                        <p class="mb-0">
                            Check-in: <strong>{{ $todayAttendance->waktu_masuk }}</strong>
                            @if($todayAttendance->waktu_keluar)
                                | Check-out: <strong>{{ $todayAttendance->waktu_keluar }}</strong>
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading mb-1">Anda Belum Absen Hari Ini</h5>
                        <p class="mb-2">Jangan lupa untuk melakukan absensi</p>
                        <a href="{{ route('attendance.create') }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-clock-history me-1"></i> Absen Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Absensi Bulan Ini -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1 small">Absensi Bulan Ini</p>
                            <h3 class="fw-bold mb-0">{{ $monthlyAttendance }}</h3>
                            <small class="text-success">
                                <i class="bi bi-calendar-check"></i> dari {{ $workingDays }} hari kerja
                            </small>
                        </div>
                        <div class="">
                            <i class="bi bi-calendar-check text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keterlambatan -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1 small">Keterlambatan</p>
                            <h3 class="fw-bold mb-0">{{ $lateCount }}</h3>
                            <small class="text-warning">
                                <i class="bi bi-clock-history"></i> bulan ini
                            </small>
                        </div>
                        <div class="">
                            <i class="bi bi-clock-history text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gaji Bulan Ini -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted mb-1 small">Gaji Bulan Ini</p>
                            <h3 class="fw-bold mb-0">{{ number_format($salary, 0, ',', '.') }}</h3>
                            <small class="text-success">
                                <i class="bi bi-cash-coin"></i> IDR
                            </small>
                        </div>
                        <div class="">
                            <i class="bi bi-cash-coin text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-lightning-charge text-primary me-2"></i>Aksi Cepat
                    </h5>
                    <div class="d-grid gap-2">
                        <form action="{{ route('attendance.checkin') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-primary w-100 text-start">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Absen Masuk
                            </button>
                        </form>
                        <form action="{{ route('attendance.checkout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger w-100 text-start">
                                <i class="bi bi-box-arrow-right me-2"></i> Absen Keluar
                            </button>
                        </form>
                        <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-clock-history me-2"></i> Riwayat Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Attendance -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-clock-history text-primary me-2"></i>Riwayat Absensi Terakhir
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAttendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->locale('id')->isoFormat('DD MMM YYYY') }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $attendance->waktu_masuk ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($attendance->waktu_keluar)
                                            <span class="badge bg-danger">{{ $attendance->waktu_keluar }}</span>
                                        @else
                                            <span class="badge bg-secondary">Belum</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->status_absensi === 'Hadir')
                                            @if($attendance->is_late)
                                                <span class="badge bg-warning">Terlambat</span>
                                            @else
                                                <span class="badge bg-success">Tepat Waktu</span>
                                            @endif
                                        @else
                                            <span class="badge bg-info">{{ $attendance->status_absensi }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada data absensi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengumuman -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-megaphone text-primary me-2"></i>Pengumuman
                    </h5>
                    @forelse($announcements as $announcement)
                    <div class="alert alert-light border-start border-primary border-4" role="alert">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h6 class="alert-heading">{{ $announcement->title }}</h6>
                                <p class="mb-0">{{ $announcement->content }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i> {{ $announcement->created_at->locale('id')->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center py-3">Tidak ada pengumuman</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection