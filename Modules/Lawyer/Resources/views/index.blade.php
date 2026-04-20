@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.lawyers'))

@section('content')

<table class="table table-bordered table-striped" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.name')</th>
            <th>@lang('trans.phone')</th>
            <th>@lang('trans.email')</th>
            <th>@lang('trans.type')</th>
            <th>@lang('trans.status')</th>
            <th>@lang('trans.datetime')</th>
            <th>@lang('trans.actions')</th>
        </tr>
    </thead>
</table>

@endsection

@push('js')
<script>
    var table = $('#DataTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,

        ajax: {
            url: '{{ route("admin.datatable-lawyers") }}',
            data: function(d) {
                if (d.order && d.order.length > 0) {
                    d.sort_column = d.columns[d.order[0].column].name ?? 'id';
                    d.sort_direction = d.order[0].dir;
                } else {
                    d.sort_column = 'id';
                    d.sort_direction = 'desc';
                }
            }
        },

        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },

            // ⚠️ مهم: الاسم بيتعمله render لأنه HTML
            { 
                data: 'name', 
                name: 'first_name',
                orderable: true,
                searchable: true
            },

            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'type', orderable: false, searchable: false },
            { data: 'status', orderable: false, searchable: false },
            { data: 'created_at', orderable: false, searchable: false },

            // actions فيها HTML
            { data: 'actions', orderable: false, searchable: false },
        ],

        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],

    });

    // تنظيف المودال بعد أي request
    table.on('xhr', function () {
        $('.modal').modal('hide');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });

</script>
@endpush