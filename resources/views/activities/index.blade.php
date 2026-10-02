@extends('layouts.app')

@section('content')
    <style>
        .pagination {
            display: flex;
            gap: 6px;
            margin-top: 20px;
            align-items: center;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        .pagination a {
            color: #333;
            background: #fff;
        }

        .pagination .active {
            background: #333;
            color: white;
        }

        .pagination .disabled {
            color: #aaa;
            background: #eee;
        }
    </style>

    <form method="GET" action="{{ route('activities.index') }}">

        <input
            type="text"
            name="search"
            placeholder="Cari kode atau judul..."
            value="{{ request('search') }}"
        >

        <select name="category_id">
            <option value="">Semua Kategori</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(request('category_id') == $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Semua Status</option>

            <option value="draft" @selected(request('status') === 'draft')>
                Draft
            </option>

            <option value="published" @selected(request('status') === 'published')>
                Published
            </option>

            <option value="completed" @selected(request('status') === 'completed')>
                Completed
            </option>
        </select>

        <select name="sort">
            <option value="latest" @selected(request('sort', 'latest') === 'latest')>
                Terbaru
            </option>

            <option value="oldest" @selected(request('sort') === 'oldest')>
                Terlama
            </option>
        </select>

        <button type="submit">Filter</button>

    </form>

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

            <p>
                {{ $activity->activity_date->format('d M Y') }}
            </p>

            <p>
                Status: {{ $activity->status }}
            </p>

        </article>

    @empty

        <p>Belum ada kegiatan.</p>

    @endforelse

    <div>
        @if ($activities->hasPages())
            <div class="pagination">
                @if ($activities->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $activities->previousPageUrl() }}">Previous</a>
                @endif

                @foreach ($activities->getUrlRange(1, $activities->lastPage()) as $page => $url)
                    @if ($page == $activities->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($activities->hasMorePages())
                    <a href="{{ $activities->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>

@endsection

