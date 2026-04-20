@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.terms'))

@section('content')

<form method="POST" action="{{ route(activeGuard().'.terms.update', $Model) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $Model->slug }}">
    </div>

    <div class="mb-3">
        <label>Arrangement</label>
        <input type="number" name="arrangement" class="form-control" value="{{ $Model->arrangement }}">
    </div>

    <hr>

    <h4>Sections AR</h4>
    <textarea name="sections_ar" class="form-control" rows="12">
{{ json_encode($Model->sections_ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
    </textarea>

    <hr>

    <h4>Sections EN</h4>
    <textarea name="sections_en" class="form-control" rows="12">
{{ json_encode($Model->sections_en, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
    </textarea>

    <button class="btn btn-primary mt-3">Update</button>
</form>

@endsection