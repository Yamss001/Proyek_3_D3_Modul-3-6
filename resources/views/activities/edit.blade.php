@extends('layouts.app')

@section('content')
    <h1>Ubah Kegiatan</h1>
    
    <form action="{{ route('activities.update', $activity) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Memanggil form isian yang sama --}}
        @include('activities._form')
        
        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('activities.show', $activity) }}">Batal</a>
    </form>
@endsection