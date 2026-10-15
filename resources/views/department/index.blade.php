@extends('layouts.master')
@section('title', 'Daftar Department')
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
<a href="/department/create" class="btn btn-primary mb-3">Tambah Department</a> 
    <table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Department</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($departments as $department)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{$department->nama_department}}</td>
            <td>
                <form action="/department/{{$department->id}}" method="POST" style="display:inline;">
                        <a href="/department/{{$department->id}}/edit" class="btn btn-secondary btn-sm">Edit</a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        @endforelse
        
    </tbody>
    </table>
@endsection