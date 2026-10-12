@csrf
<div><label for="title" class="field-label">Judul artikel</label><input id="title" name="title" type="text" class="w-full" value="{{ old('title',$post->title ?? '') }}" required><x-input-error :messages="$errors->get('title')" class="mt-2" /></div>
<div><label for="body" class="field-label">Isi artikel</label><textarea id="body" name="body" rows="9" class="w-full" required>{{ old('body',$post->body ?? '') }}</textarea><x-input-error :messages="$errors->get('body')" class="mt-2" /></div>
<div class="flex flex-wrap gap-3 items-center"><button type="submit">Simpan tulisan ↗</button><a href="{{ route('posts.index') }}" class="store-link">Batal</a></div>
