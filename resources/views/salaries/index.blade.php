@extends('layouts.master')
@section('title', 'Daftar Gaji Karyawan')
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
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<a href="/salaries/create" class="btn btn-primary mb-3">Tambah Data Gaji Karyawan</a>
<table class="table table-striped table-bordered table-hover">
    <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Bulan</th>
            <th scope="col">Gaji Pokok</th>
            <th scope="col">Tunjangan</th>
            <th scope="col">Potongan</th>
            <th scope="col">Total Gaji</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($salaries as $salary)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $salary->employee->nama_lengkap }}</td>
                <td>{{ $salary->bulan }}</td>
                <td>{{ $salary->gaji_pokok }}</td>
                <td>{{ $salary->tunjangan }}</td>
                <td>{{ $salary->potongan }}</td>
                <td>{{ $salary->total_gaji }}</td>
                <td>
                    <form action="/salaries/{{$salary->id}}" method="POST" style="display:inline;">
                        <a href="/salaries/{{$salary->id}}/edit" class="btn btn-secondary btn-sm">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data gaji karyawan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection