@extends('layouts.master')
@section('title', 'Form Input Position')
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
<a href="/position/create" class="btn btn-primary mb-3">Tambah Jabatan</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Jabatan</th>
            <th scope="col">Gaji Pokok</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($positions as $position)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$position->nama_jabatan}}</td>
            <td>{{$position->gaji_pokok}}</td>
            <td>
                <form action="/position/{{$position->id}}" method="POST" style="display:inline;">
                        <a href="/position/{{$position->id}}/edit" class="btn btn-secondary btn-sm">Edit</a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <th scope="row" colspan="4">Data tidak ditemukan</th>
        </tr>
        @endforelse
        </tr>
    </tbody>
</table>
@endsection