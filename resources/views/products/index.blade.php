@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>


<div class="card">
    <form action="{{ route('product.search') }}" method="get" class="card-header">
        <div class="form-row justify-content-between">
            <div class="col-md-2">
                <input type="text" name="title" placeholder="Product Title" class="form-control">
            </div>
            <div class="col-md-2">
                <select name="variant" id="" class="form-control">
                    <option>Select</option>
                    <option value="red" >Red</option>
                    <option value="green" >Green</option>
                    <option value="blue" >Blue</option>
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price Range</span>
                    </div>
                    <input type="text" name="price_from" aria-label="First name" placeholder="From"
                        class="form-control">
                    <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" placeholder="Date" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="card-body">
        <div class="table-response">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                {{-- {{$all_data}} --}}
                <tbody>
                    @foreach ( $all_data as $row )
                    <tr>
                        <td>{{ $row->id }}</td>
                        {{-- <td>T-Shirt <br> Created at : 25-Aug-2020</td> --}}
                        <td>{{ $row->title }} <br> Created at : {{ $row->created_at }}</td>
                        <td>{{ $row->description }}</td>
                        <td>
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">
                                @foreach ( $row->product_variant as $items )
                                <dt class="col-sm-3 pb-0">
                                    {{-- SM/ Red/ V-Nick --}}
                                    {{ $items->variant  }}
                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 pb-0">Price : {{ $items->product_viriant_price?$items->product_viriant_price->price:'' }}</dt>
                                        <dd class="col-sm-8 pb-0">InStock : {{ $items->product_viriant_price?$items->product_viriant_price->stock: '' }}</dd>
                                    </dl>
                                </dd>
                                @endforeach
                            </dl>
                            {{-- <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show
                                more</button> --}}
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>

    </div>

    <div class="card-footer">
        <div class="row justify-content-between">
            <div class="col-md-6">
                {{-- <p>Showing 1 to 10 out of 100</p> --}}
                showing {{$all_data->firstItem()}} to {{$all_data->lastItem()}} out of {{$all_data->total()}}
                
            </div>
            <div class="col-md-2">
                {{  $all_data->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
