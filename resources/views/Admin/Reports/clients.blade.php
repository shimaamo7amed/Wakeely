@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', 'Clients Report')

@section('content') <button class="btn btn-primary my-2" id="printt">Print / Save PDF</button>

<div class="container" id="toPrint">
    <h4 class="mb-4">Clients Report</h4>


@include('Admin.Reports.filter-form')

<div class="row mb-4 text-center">

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Total Clients</h6>
            <h3 id="total_clients">{{ $total_clients }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Active Clients</h6>
            <h3 id="active_clients">{{ $active_clients }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>New Clients</h6>
            <h3 id="new_clients">{{ $new_clients }}</h3>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h5>Top Clients</h5>
        <table class="table table-bordered text-center bg-white">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Bids</th>
                    <th>Total Spent</th>
                </tr>
            </thead>
            <tbody id="top_clients">
                @foreach($top_clients as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->total_bids }}</td>
                    <td>{{ $c->total_spent }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</div>

<script>
function loadClientsReport(){
    fetch('/admin/reports/clients-live?' + new URLSearchParams({
        range: '{{ request("range") }}',
        from: '{{ request("from") }}',
        to: '{{ request("to") }}'
    }))
    .then(res => res.json())
    .then(data => {

        document.getElementById('total_clients').innerText = data.total_clients;
        document.getElementById('active_clients').innerText = data.active_clients;
        document.getElementById('new_clients').innerText = data.new_clients;

        let rows = '';
        data.top_clients.forEach(c=>{
            rows += `
                <tr>
                    <td>${c.name}</td>
                    <td>${c.bids}</td>
                    <td>${c.spent}</td>
                </tr>
            `;
        });

        document.getElementById('top_clients').innerHTML = rows;
    });
}

setInterval(loadClientsReport,5000);
loadClientsReport();
</script>

@endsection
