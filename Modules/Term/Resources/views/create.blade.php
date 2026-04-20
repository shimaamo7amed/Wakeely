@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.terms'))

@section('content')

<form method="POST" action="{{ route(activeGuard().'.terms.store') }}">
    @csrf

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Arrangement</label>
        <input type="number" name="arrangement" class="form-control" required>
    </div>

    <hr>

    <h4>Sections AR</h4>

    <textarea name="sections_ar" class="form-control" rows="10" placeholder='[
{
  "id": "intro",
  "type": "hero",
  "title": "مقدمة",
  "content": "نص..."
}
]'></textarea>

    <hr>

    <h4>Sections EN</h4>

    <textarea name="sections_en" class="form-control" rows="10" placeholder='[
{
  "id": "intro",
  "type": "hero",
  "title": "Intro",
  "content": "text..."
}
]'></textarea>

    <button class="btn btn-success mt-3">Save</button>

</form>

@endsection