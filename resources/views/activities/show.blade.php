<br>
    <a href="{{ route('activities.edit', $activity) }}">Ubah Kegiatan</a>
    
    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">Hapus</button>
    </form>
    <br><br>


    <div style="margin-top: 20px;">
    <a href="{{ route('activities.edit', $activity) }}">
        <button type="button">Edit Kegiatan</button>
    </a>

    <a href="{{ route('activities.index') }}">
        <button type="button">Kembali</button>
    </a>
</div>