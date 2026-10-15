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

@if(auth()->user()->role === 'admin')
<a href="/salaries/create" class="btn btn-primary mb-3">Tambah Data Gaji Karyawan</a>
@endif

<table class="table table-striped table-bordered table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Nama Karyawan</th>
            <th>Bulan</th>
            <th>Gaji Pokok</th>
            <th>Tunjangan</th>
            <th>Potongan</th>
            <th>Total Gaji</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($salaries as $salary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $salary->employee->nama_lengkap }}</td>
                <td>{{ $salary->bulan }}</td>
                <td>{{ $salary->gaji_pokok }}</td>
                <td>{{ $salary->tunjangan }}</td>
                <td>{{ $salary->potongan }}</td>
                <td>{{ $salary->total_gaji }}</td>

                <td>
                    @if(auth()->user()->role === 'admin')
                    <form action="/salaries/{{ $salary->id }}" method="POST" style="display:inline;">
                        <a href="/salaries/{{ $salary->id }}/edit" class="btn btn-secondary btn-sm">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus?')"
                            class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                    @endif
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
