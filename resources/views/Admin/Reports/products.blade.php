@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', 'Products Report')

@section('content') <button class="btn btn-primary my-2" id="printt">Print / Save PDF</button>

<div class="container" id="toPrint">
    <h4 class="mb-4">Products Report</h4>


@include('Admin.Reports.filter-form')

<div class="row mb-4 text-center">

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Products</h6>
            <h3 id="total_products">{{ $total_products }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Active Products</h6>
            <h3 id="active_products">{{ $active_products }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Ended Products</h6>
            <h3 id="ended_products">{{ $ended_products }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Revenue</h6>
            <h3 id="total_revenue">{{ number_format($total_revenue,2) }}</h3>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h5>Top Products</h5>
        <table class="table table-bordered text-center bg-white">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Bids</th>
                    <th>Highest Bid</th>
                </tr>
            </thead>
            <tbody id="top_products">
                @foreach($top_products as $p)
                <tr>
                    <td>{{ $p->title_en }}</td>
                    <td>{{ $p->bids_count }}</td>
                    <td>{{ $p->highest_bid }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</div>

<script>
function loadProductsReport(){
    fetch('/admin/reports/products-live?' + new URLSearchParams({
        range: '{{ request("range") }}',
        from: '{{ request("from") }}',
        to: '{{ request("to") }}'
    }))
    .then(res => res.json())
    .then(data => {

        document.getElementById('total_products').innerText = data.total_products;
        document.getElementById('active_products').innerText = data.active_products;
        document.getElementById('ended_products').innerText = data.ended_products;
        document.getElementById('total_revenue').innerText = data.total_revenue;

        let rows = '';
        data.top_products.forEach(p=>{
            rows += `
                <tr>
                    <td>${p.title}</td>
                    <td>${p.bids}</td>
                    <td>${p.price}</td>
                </tr>
            `;
        });

        document.getElementById('top_products').innerHTML = rows;
    });
}

setInterval(loadProductsReport,5000);
loadProductsReport();
</script>

@endsection
