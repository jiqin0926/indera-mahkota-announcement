@if($errors->any())
    <div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
@endif
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" maxlength="50" required
           value="{{ old('name', $category->name ?? '') }}">
</div>