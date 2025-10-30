@extends('layouts.master')
@section('title', 'Data Absensi Pegawai')
@section('content')
<div class="container">

    <a href="{{ route('attendance.create') }}" class="btn btn-primary mb-3">Absen Masuk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $absen)
            <tr>
                <td>{{ $absen->id }}</td>
                <td>{{ $absen->employee->nama_lengkap }}</td>
                <td>{{ $absen->tanggal }}</td>
                <td>{{ \Carbon\Carbon::parse($absen->waktu_masuk)->format('H:i:s') }}</td>
                <td>{{ $absen->waktu_keluar ? \Carbon\Carbon::parse($absen->waktu_keluar)->format('H:i:s') : '-' }}</td>
                <td>{{ $absen->status_absensi }}</td>
                <td>
                    @if(!$absen->waktu_keluar)
                    <form action="{{ route('attendance.update', $absen->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Absen Keluar</button>
                    </form>
                    @endif
                    <form action="{{ route('attendance.destroy', $absen->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection