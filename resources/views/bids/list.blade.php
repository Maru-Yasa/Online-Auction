@extends('layouts.admin')

@section('content')
    
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-bids-left align-bids-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Auctions</h2>
                        <h5 class="text-white op-7 mb-2">Manage data bids</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            @if (Session::has('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="table-responsive card p-3">
                <table id="data_table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <td>No</td>
                            <td>Name</td>
                            <td>Auction</td>
                            <td>Offer</td>
                            <td>Time</td>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach ($data as $bid)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="d-flex align-items-center">
                                    <div class="avatar-sm mr-3">
                                        <img src="{{ Avatar::create($bid->user->name)->toBase64() }}" alt="..." class="avatar-img rounded-circle">
                                    </div>    
                                    {{ $bid->user->username }}
                                </td>
                                <td><a href="{{ route('auctions.detail',$bid->auction->id) }}">{{ $bid->auction->id }}</a></td>
                                <td>@currency($bid->offer)</td>
                                <td>{{ $bid->created_at }}</td>
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>
            </div>
            
        </div>



    @section('js')

        <script>
            $('#data_table').DataTable()
        </script>

    @endsection


@endsection