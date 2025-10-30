@extends('layouts.master')
@section('title', 'Daftar Pegawai')
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
<a href="/employees/create" class="btn btn-primary mb-3">Tambah Pegawai</a> 
<table class="table table-striped table-bordered table-hover">
    <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employees as $employee)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>
                    <form action="/employees/{{$employee->id}}" method="POST" style="display:inline;">
                        <a href="/employees/{{$employee->id}}" class="btn btn-info btn-sm">Detail</a>
                        <a href="/employees/{{$employee->id}}/edit" class="btn btn-secondary btn-sm">Edit</a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada data pegawai.</td>
            </tr>
        @endforelse  
    </tbody>
</table>

@endsection