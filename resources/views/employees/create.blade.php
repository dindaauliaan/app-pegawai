@extends('layouts.master')
@section('title', 'Form Input Pegawai')
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
    <form action="/employees" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">No. Telepon</label>
            <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon">
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
        </div>
        <div class="mb-3">
            <label for="status">Status:</label>
            <select id="status" name="status"class="form-select">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-select">
                <option value="">-- Pilih Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->nama_department }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="jabatan_id" class="form-select">
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>  
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection