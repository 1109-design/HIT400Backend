@extends('layouts.app')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">RA0449</a></td>
                            <td>Udin Wayang</td>
                            <td>Nasi Padang</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA5324</a></td>
                            <td>Jaenab Bajigur</td>
                            <td>Gundam 90' Edition</td>
                            <td><span class="badge badge-warning">Shipping</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA8568</a></td>
                            <td>Rivat Mahesa</td>
                            <td>Oblong T-Shirt</td>
                            <td><span class="badge badge-danger">Pending</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1453</a></td>
                            <td>Indri Junanda</td>
                            <td>Hat Rounded</td>
                            <td><span class="badge badge-info">Processing</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1998</a></td>
                            <td>Udin Cilok</td>
                            <td>Baby Powder</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection
