<label for="title">Judul</label>
<input id="title" name="title" value="{{ old('title', $activity->title ?? '') }}">
@error('title')
    <p class="error" style="color: red;">{{ $message }}</p>
@enderror

<label for="code">Kode</label>
<input
    id="code"
    name="code"
    value="{{ old('code', $activity->code ?? '') }}"
>

@error('code')
    <p class="error" style="color: red;">{{ $message }}</p>
@enderror

<label for="description">Deskripsi</label>
<textarea id="description" name="description">{{ old('description', $activity->description ?? '') }}</textarea>
@error('description')
    <p class="error" style="color: red;">{{ $message }}</p>
@enderror

<label for="activity_date">Tanggal</label>
<input type="date" id="activity_date" name="activity_date" value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}">
@error('activity_date')
    <p class="error" style="color: red;">{{ $message }}</p>
@enderror

<label for="category_id">Kategori</label>
<select id="category_id" name="category_id">
    <option value="">-- Pilih Kategori --</option>

    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @selected(old('category_id', $activity->category_id ?? '') == $category->id)>
            {{ $category->name }}
        </option>
    @endforeach
</select>

@error('category_id')
    <p class="error" style="color: red;">{{ $message }}</p>
@enderror
