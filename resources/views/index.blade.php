@extends('layouts.admin')

@section('content')

<div class="">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    {{-- <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5> --}}
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">

            <div class="col-md-3">
                <div class="card card-warning full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h1><i class="fa fa-users text-white"></i> | Users</h1>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 50px;z-index: 99;">{{ $users_count }}</h1>
                    </div>
                    {{-- <i class="fa fa-users text-warning" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-success full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h1><i class="fa fa-boxes text-white"></i> | Items</h1>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 50px;z-index: 99;">{{ $items_count }}</h1> 
                    </div>
                    {{-- <i class="fa fa-boxes text-success" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-danger full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h1><i class="fa fa-table text-white"></i> | Auctions</h1>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 50px;z-index: 99;">{{ $auctions_count }}</h1> 
                    </div>
                    {{-- <i class="fa fa-table text-danger" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-info full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h1><i class="fa fa-gavel text-white"></i> | Bids</h1>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 50px;z-index: 99;">{{ $bids_count }}</h1> 
                    </div>
                    {{-- <i class="fa fa-money-bill text-info" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>

            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Overall statistics</div>
                        <div class="card-category">Information about statistics in system</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-1">{{ $users_count }}</div>
                                <h6 class="fw-bold mt-3 mb-0">Users</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-2">{{ $users_count }}</div>
                                <h6 class="fw-bold mt-3 mb-0">Auctions</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-3"></div>
                                <h6 class="fw-bold mt-3 mb-0">Subscribers</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Total biding offers</div>
                        <div class="row py-3">
                            <div class="col-md-4 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-warning op-8">Total bid summary</h6>
                                    <h3 class="fw-bold">@currency($sum_bid)</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8">Total tax's income</h6>
                                    <h3 class="fw-bold">@currency($sum_bid * 10 / 100)</h3>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Top Auction offer</div>
                    </div>
                    <div class="card-body pb-0">
                        @foreach ($best_auction as $auction)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="/img/items/{{ $auction->item->image }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $auction->item->name }}</h6>
                                <small class="text-muted">{{ $auction->item->description }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">@currency($auction->best_offer)</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title fw-mediumbold">Suggested People</div>
                        <div class="card-list">
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">Jimmy Denis</div>
                                    <div class="status">Graphic Designer</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">Chad</div>
                                    <div class="status">CEO Zeleaf</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">Talha</div>
                                    <div class="status">Front End Designer</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">John Doe</div>
                                    <div class="status">Back End Developer</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">Talha</div>
                                    <div class="status">Front End Designer</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">Jimmy Denis</div>
                                    <div class="status">Graphic Designer</div>
                                </div>
                                <button class="btn btn-icon btn-primary btn-round btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: "{{ $users_count }}",
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:1000,
        maxValue:100,
        width:7,
        text: "{{ $auctions_count }}",
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: "{{ $bids_count }}",
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets : [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>
@endsection

@endsection