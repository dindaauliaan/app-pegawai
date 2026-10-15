@extends('layouts.master')
@section('title', 'Form Input Pegawai')
@section('content')
    <table class="table table-bordered">
        <thead class="table-primary text-center">
            <tr>
                <th colspan="2" class="fs-5">Detail Pegawai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Nama Lengkap</th>
                <td>{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th scope="row">Nomor Telepon</th>              
                <td>{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr>
                <th scope="row">Tanggal Lahir</th>      
                <td>{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th scope="row">Alamat</th>
                <td>{{ $employee->alamat }}</td>
            </tr>
            <tr>
                <th scope="row">Tanggal Masuk</th>
                <td>{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>{{ $employee->status }}</td>
            </tr>
            <tr>
                <th scope="row">Department</th>
                <td>{{ $employee->department->nama_department}}</td>
            </tr>
            <tr>
                <th scope="row">Position</th>
                <td>{{ $employee->position->nama_jabatan}}</td>
            </tr>
        </tbody>
    </table>
    <a href="/employees" class="btn btn-secondary mt-3">Kembali</a>
@endsection