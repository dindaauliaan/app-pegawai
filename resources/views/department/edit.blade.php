@extends('layouts.master')
@section('title', 'Form Input Department')
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
    <form action="/department/{{$departments->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Department</label>
            <input type="text" class="form-control" name="nama_department" value="{{ $departments->nama_department }}">
        </div>
    <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection
