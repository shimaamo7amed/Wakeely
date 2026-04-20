@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.faq'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['question_ar'] }}
        </td>
        <td class="text-center">
            {{ $Model['answer_ar'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {{ $Model['question_en'] }}
        </td>
        <td class="text-center">
            {{ $Model['answer_en'] }}
        </td>
    </tr>
</table>

@endsection
