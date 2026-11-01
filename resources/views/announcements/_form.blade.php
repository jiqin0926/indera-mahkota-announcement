@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" maxlength="150" required
           value="{{ old('title', $announcement->title ?? '') }}">
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $announcement->category_id ?? '') == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Priority</label>
        <select name="priority" class="form-select" required>
            @foreach(['normal','important','urgent'] as $p)
                <option value="{{ $p }}" @selected(old('priority', $announcement->priority ?? 'normal') == $p)>{{ ucfirst($p) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Publish date</label>
        <input type="date" name="publish_date" class="form-control" required
               value="{{ old('publish_date', $announcement->publish_date ?? date('Y-m-d')) }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Body</label>
    <textarea name="body" id="body" rows="6" class="form-control" maxlength="2000" required>{{ old('body', $announcement->body ?? '') }}</textarea>
    <small class="text-muted"><span id="count">0</span>/2000 characters</small>
</div>

@push('scripts')
<script>
    const body = document.getElementById('body');
    const count = document.getElementById('count');
    const update = () => count.textContent = body.value.length;
    body.addEventListener('input', update);
    update();
</script>
@endpush