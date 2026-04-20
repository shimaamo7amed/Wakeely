@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle',  __('trans.clients')  )
@section('content')


{{-- <div class="row">
    @if(hasPermission('add_clients'))
        <div class="my-2 col-6 text-sm-start">
            <a href="{{ route(activeGuard().'.clients.create') }}" class="main-btn">@lang('trans.add_new')</a>
        </div>
    @endif
</div> --}}

<table class="table table-bordered dataTable table-striped" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.name')</th>
            <th>@lang('trans.phone')</th>
            <th>@lang('trans.email')</th>
            <th>@lang('trans.image')</th>
            <th>@lang('trans.status')</th>
            <th>@lang('trans.datetime')</th>
            <th>@lang('trans.actions')</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection



@push('js')
    <script>
        var table = $('#DataTable').DataTable({
            stateSave: true,
            oLanguage: {
                sUrl: $('meta[name="DT_Lang"]').attr('content')
            },
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        stripHtml: false,
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.datatable-clients") }}',
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
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'image', orderable: false, searchable: false },
                {data: 'status', orderable: false, searchable: false },
                { data: 'created_at',orderable: false, searchable: false },
                { data: 'actions',orderable: false, searchable: false },
            ]
        });
        
        table.on('xhr', function () {
            $('.modal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });
        
        $(document).on("submit", ".form-wallet", function (event) {
            $('.modal.show').modal('hide');
            $('.modal-backdrop').remove();
            event.preventDefault();
            var $form = $(this);
            $.ajax({
                type: $form.attr("method"),
                url: $form.attr("action"),
                data: $form.serialize(),
                dataType: 'json',
                cache: false,
                success: function (response) {
                    table.ajax.reload(null, false);
                }
            });
        });

    </script>
@endpush