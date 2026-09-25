@extends('layouts.app')

@section('content')
    <h1>Tambah Kegiatan Baru</h1>
    
    <form action="{{ route('activities.store') }}" method="POST">
        @csrf
        
        {{-- Memanggil partial form yang sudah kita buat --}}
        @include('activities._form')
        
        <br><br>
        <button type="submit">Simpan Kegiatan</button>
        <a href="{{ route('activities.index') }}">Batal</a>
    </form>
@endsection