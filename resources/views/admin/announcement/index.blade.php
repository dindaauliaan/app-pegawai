@extends('layouts.master')
@section('title', 'Kelola Pengumuman')
@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">
                    <i class="bi bi-megaphone text-primary me-2"></i>Kelola Pengumuman
                </h2>
            </div>
            <a href="{{ route('announcement.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-plus-circle"></i> Tambah Pengumuman
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Judul</th>
                                    <th width="40%">Isi</th>
                                    <th width="15%">Dibuat</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($announcements as $announcement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $announcement->title }}</strong></td>
                                    <td>{{ Str::limit($announcement->content, 100) }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $announcement->created_at->locale('id')->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('announcement.edit', $announcement->id) }}" 
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                                edit
                                            </a>
                                            <form action="{{ route('announcement.destroy', $announcement->id) }}" 
                                                method="POST" 
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-2 text-muted"></i>
                                        <p class="text-muted">Belum ada pengumuman</p>
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
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush
@endsection