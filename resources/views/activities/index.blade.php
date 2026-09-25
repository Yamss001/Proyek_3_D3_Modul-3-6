@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>
    <div style="margin-bottom: 20px;">
    <a href="{{ route('activities.create') }}">
        <button type="button">Tambah Kegiatan Baru</button>
    </a>
    </div>
    @forelse ($activities as $activity)
        <article class="card">
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
@endsection