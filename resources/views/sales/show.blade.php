@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Sale Details</h2>
                    <div>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back to Sales</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Sale Information</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Number:</th>
                                    <td>{{ $sale->number }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $sale->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($sale->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Client Information</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Name:</th>
                                    <td>{{ $sale->client->name }} {{ $sale->client->lastname }}</td>
                                </tr>
                                <tr>
                                    <th>DNI:</th>
                                    <td>{{ $sale->client->dni }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $sale->client->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h4>Products</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>${{ number_format($detail->unit_price, 2) }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td class="text-end">${{ number_format($detail->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-end">${{ number_format($sale->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($sale->status !== 'cancelled')
                        <div class="mt-4">
                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to cancel this sale?')">
                                    Cancel Sale
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 