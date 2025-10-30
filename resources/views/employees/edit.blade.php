@extends('layouts.master')
@section('title', 'Edit Data Pegawai')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1 class="mb-4">Form Pegawai</h1>
    <form action="/employees/{{ $employee->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $employee->nama_lengkap }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">No. Telepon</label>
            <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $employee->nomor_telepon }}">
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $employee->tanggal_lahir }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $employee->alamat }}">
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $employee->tanggal_masuk }}">
        </div>
        <div class="mb-3">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $employee->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-select">
                <option value="">-- Pilih Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->nama_department }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="jabatan_id" class="form-select">
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}" {{ $employee->jabatan_id == $position->id ? 'selected' : '' }}>{{ $position->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>  
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>

@endsection