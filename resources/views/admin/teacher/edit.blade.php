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
                                <h3 class="card-title">Teacher Update</h3>
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
                            <form class="form-horizontal" action="{{route('admin::updateTeacher',$userById->id)}}"
                                  method="post">
                                <div class="card-body">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" value="{{$userById->name}}"
                                                   placeholder="Enter Teacher Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="email" value="{{$userById->email}}"
                                                   placeholder="Enter Teacher Email"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Phone <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="phone" value="{{$userById->phone}}"
                                                   placeholder="Enter Teacher Phone"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="address" value="{{$userById->address}}"
                                                   placeholder="Enter Teacher Address"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">City <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="city" value="{{$userById->city}}"
                                                   placeholder="Enter Teacher City"/>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="country_id" id="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $row)
                                                <option value="{{$row->id}}" @if($userById->country_id==$row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">State <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="state_id" id="state">
                                            <option value="">Select State</option>
                                            @foreach($states as $row)
                                                <option value="{{$row->id}}" @if($userById->state_id==$row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Zip code <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="zip_code" value="{{$userById->zip_code}}"
                                               placeholder="Enter zip code"/>
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
        <script>
            $("#country").on("change",function () {
                $.ajax({
                    url: '{{route('getState')}}',
                    type: 'POST',
                    data: {_token:'<?php echo csrf_token()?>', country_id: $(this).val()},
                    success: function (data) {
                        $('#state').html(data);
                    }
                });
            });
        </script>
    @endpush
@endsection