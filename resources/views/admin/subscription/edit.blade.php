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
                                <h3 class="card-title">Subscrition Update</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br/>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>{{Session::get('success')}}</strong>
                                </div>
                            @endif
                            <form class="form-horizontal" action="{{route('admin::updateSubscription',$info->id)}}"
                                  method="post">
                                <div class="card-body">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Subscription Plan Name <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" value="{{$info->name}}"
                                                   placeholder="Enter Subscription Plan Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Validity <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="validity" value="{{$info->validity}}"
                                                   placeholder="Enter Validity"/>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Validity Type <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="validity_type" id="validity_type">
                                            <option value="Days" @if($info->validity_type=="Days") selected @endif>Days</option>
                                            <option value="Months" @if($info->validity_type=="Months") selected @endif>Months</option>
                                            <option value="Year" @if($info->validity_type =="Year") selected @endif>Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Price <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="price" value="{{$info->price}}"
                                               placeholder="Enter Price"/>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <div class="col-md-12" style="text-align: center">
                                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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