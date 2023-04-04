@extends('layouts.admin')

@section('content')

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Wellcome {{ $user->username }}</h2>
                    <h5 class="text-white op-7 mb-2">{{ $user->username }}'s general information</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12 col-12 d-md-none">
                <div class="card p-3 text-center">
                    <div class="avatar avatar-xxl mx-auto">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <span>{{ Auth::user()->role }}</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h3><i class="fa fa-gavel text-white"></i> | Bids transaction</h3>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 50px;z-index: 99;">{{ $total_bid }}</h1> 
                    </div>
                    {{-- <i class="fa fa-money-bill text-info" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-success full-height position-relative">
                    <div class="px-3 py-1 border-0" style="bor">
                        <h3><i class="fa fa-money-bill-wave text-white"></i> | Spent</h3>
                    </div>
                    <div class="card-body row justify-content-center align-items-center text-center">
                        <h1 class="mr-3" style="font-size: 30px;z-index: 99;">@currency($spent)</h1></h1> 
                    </div>
                    {{-- <i class="fa fa-boxes text-success" style="font-size: 150px; position: absolute; right: 0;bottom: 0;opacity: 0.3;z-index: 1; "></i> --}}
                </div>
            </div>
    
            <div class="col-md-4 col-12 d-md-block d-none">
                <div class="card p-3 text-center">
                    <div class="avatar avatar-xxl mx-auto">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <span>{{ Auth::user()->role }}</span>
                </div>
            </div>
    
            <div class="col-md-8 col-12 pe-3">
                <div class="card p-3 table-responsive">
                    <h2>Bid History</h2>
                    <table id="data_table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <td>No</td>
                                <td>Auction</td>
                                <td>offer</td>
                                <td>Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids_history as $bid)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bid->auction->item->name }}</td>
                                    <td>@currency($bid->offer)</td>
                                    <td>{{ $bid->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-12 pe-3">
                <div class="card">
                    <h2 class="mx-3 my-2"><i class="fa fa-trophy text-warning"></i> Winner History</h2>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
                    </div>
                </div>
            </div>
    
        </div>
    </div>


    @section('js')

        <script>
            $('#data_table').DataTable()
        </script>

    @endsection


@endsection