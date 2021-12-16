@extends('admin.layouts.fancybox')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User Subscriptions Details</h3>
                            </div>
                            <table class="table table-striped table-bordered" style="text-align: center">
                                <tbody>
                                <tr>
                                    <td>User Name</td> <td>{{$info->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Subscription Name</td> <td>{{$info->subscription->name}}</td>
                                </tr>
                                <tr>
                                    <td>Purchase Date</td> <td>{{$info->purchase_date}}</td>
                                </tr>
                                <tr>
                                    <td>Start Date</td> <td>{{$info->start_date}}</td>
                                </tr>
                                <tr>
                                    <td>End Date</td> <td>{{$info->end_date}}</td>
                                </tr>
                                <tr>
                                    <td>Total Price</td> <td>{{$info->total_price}}</td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td> <td>{{$info->payment_status}}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Id </td> <td>{{$info->txn_id}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td> <td>{{$info->status}}</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-6 -->
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
    @endpush
@endsection