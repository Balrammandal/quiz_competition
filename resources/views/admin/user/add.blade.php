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
                                <h3 class="card-title">Add User</h3>
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
                            <form class="form-horizontal" action="{{route('admin::saveUser')}}" method="post">
                                <div class="card-body">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                                   placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">User Name <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="username" value="{{old('username')}}"
                                                   placeholder="Enter User Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="email" value="{{old('email')}}"
                                                   placeholder="Enter User Email"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Phone <span class="required_mark">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}"
                                                   placeholder="Enter User Phone"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Speciality</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="speciality"
                                                   placeholder="Enter Teacher Speciality">{{old('speciality')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Account Type <span class="required_mark">*</span></label>
                                       <div class="col-md-6">
                                           <select class="form-control" name="user_type" id="user_type">
                                             <option value="">Select Account Type</option>
                                             <option value="Teacher">Teacher</option>
                                             <option value="Students">Students</option>
                                             <option value="Other">Other</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Password <span class="required_mark">*</span></label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" value="{{old('password')}}"
                                               placeholder="Enter user password"/>
                                    </div>
                                   </div>
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-md-3 control-label">City <span class="required_mark">*</span></label>--}}
                                        {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" name="city" value="{{old('city')}}"--}}
                                                   {{--placeholder="Enter User City"/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">Country <span class="required_mark">*</span></label>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<select class="form-control" name="country_id" id="country">--}}
                                            {{--<option value="">Select Country</option>--}}
                                            {{--@foreach($countries as $row)--}}
                                                {{--<option value="{{$row->id}}">{{$row->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">State <span class="required_mark">*</span></label>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<select class="form-control" name="state_id" id="state">--}}
                                            {{--<option value="">Select State</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">Zip code <span class="required_mark">*</span></label>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<input type="text" class="form-control" name="zip_code" value="{{old('zip_code')}}"--}}
                                               {{--placeholder="Enter zip code"/>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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