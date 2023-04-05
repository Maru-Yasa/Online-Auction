@extends('layouts.blank')

@section('content')

    <div class="row w-100 justify-content-center" style="overflow-x: hidden;">

        <h1 class="col-12 text-center">{{ $auction->item->name }}'s Report</h1>
        <h4 class="col-12 text-center">{{ $auction->status }}</h4>

        <div class="col-12 row">
            <div class="col-6">
                <div class="col-12">                    
                    <label for="">Item's Name</label>
                    <input type="text" class="form-control" readonly value="{{ $auction->item->name }}">
                </div>
                <div class="col-12">                    
                    <label for="">Start Price</label>
                    <input type="text" class="form-control" readonly value="@currency($auction->item->start_price)">
                </div>
            </div>
            <div class="col-6">
                <div class="col-12">                    
                    <label for="">Bid Count</label>
                    <input type="text" class="form-control" readonly value="{{ $auction->bids->count() }}">
                </div>
                <div class="col-12">                    
                    <label for="">Best Bid by</label>
                    @if ($auction->bids->count() !== 0)
                    <input type="text" class="form-control" readonly value="@currency($auction->best_offer) - {{ $auction->bids->where('offer', $auction->best_offer)->first()->user->username }}">
                    @else
                    <input type="text" class="form-control" readonly value="@currency(0) - Uknown">
                    @endif
                </div>
            </div>
        </div>

        <div class="table-responsive card p-3">
            <table id="data_table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Offer</td>
                        <td>Time</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($auction->bids as $bid)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex align-items-center">
                                <div class="avatar-sm mr-3">
                                    <img src="{{ Avatar::create($bid->user->name)->toBase64() }}" alt="..." class="avatar-img rounded-circle">
                                </div>    
                                {{ $bid->user->username }}
                            </td>
                            <td>@currency($bid->offer)</td>
                            <td>{{ $bid->created_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
        
    </div>

@endsection