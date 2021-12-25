@extends('admin.layouts.adminlayout')
@section('title',"Admin : Manage Coupons")
@section('content')
    <!-- begin #content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Discount Coupons</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin::dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Coupons</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Coupons</h3>
                        <a class="btn btn-xs btn-primary fancybox fancybox.iframe"
                           style="float: right;" href="{{route('admin::addCoupon')}}" title="Add New">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="Datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Sl No</th>
                                <th>Coupon Code</th>
                                <th>Discount Amount</th>
                                <th>Discount Type</th>
                                <th>Total Used Count</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $('#Datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('admin::manageCoupon')}}',
                columns: [
                    {data: 'id', name: 'id', 'visible': false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                    {data: 'coupon_code', name: 'coupon_code'},
                    {data: 'amount', name: 'amount'},
                    {data: 'discount_type', name: 'discount_type'},
                    {data: 'applied_count', name: 'applied_count'},
                    {data: 'action', name: 'action', orderable: false, searchable: true}
                ],
                "order": [[0,'desc']],
                "pageLength": 10,
                "fnDrawCallback": function () {
                    init();
                }

            });
            function init() {
                $(document).find('.fancybox').fancybox({
                    helpers: {title: null},
                    width: 550,
                    height: 600,
                    fitToView: true,
                    autoSize: true,
                    padding: 0,
                    openEffect: 'elastic',
                    afterClose: function () {
                        var oTable = $('#Datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
            var Inactive='Inactive';
            var Active='Active';
            function status(id, status) {
                $.ajax({
                    type: "post",
                    url: '{{route('admin::CouponStatus')}}',
                    data: {
                        _token: '<?php echo csrf_token();?>',
                        id: id,
                        status: status
                    },
                    success: function (data) {
                        var resp = JSON.parse(data);
                        $('#status_' + resp.id).html(resp.html);
                        $(document).find('.child #status' + resp.id).html(resp.html);
                    }

                });
            }
        </script>
    @endpush
@endsection