@extends('adminlte::page')

@section('title', $title)
@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@push('js')
    {{--https://getbootstrap.com/docs/3.3/javascript/#modals-remove-animation--}}
    <script>
        $('#user-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var customer_name = button.data('customer_name')
            var mobile = button.data('mobile')
            var email = button.data('email')
            var date = button.data('date')
            var customer_group_id = button.data('customer_group_id')
            var customer_id = button.data('customer_id')
            var address = button.data('address')
            var title = 'Thêm mới'
            title = button.data('title')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text(title)
            modal.find('.modal-body input[name="customer_id"]').val(customer_id)
            modal.find('.modal-body input[name="customer_name"]').val(customer_name)
            modal.find('.modal-body input[name="mobile"]').val(mobile)
            modal.find('.modal-body input[name="email"]').val(email)
            modal.find('.modal-body input[name="date"]').val(date)
            modal.find('.modal-body option[value="'+customer_group_id+'"]').attr("selected","selected");
            modal.find('.modal-body textarea[name="address"]').html(address)
        })
    </script>
@endpush

@push('css')

@endpush

@section('content_header')
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('error_message'))
        <div class="alert alert-error">
            <span class="glyphicon glyphicon-flag"></span>
            {!! session('error_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{route('admin.admin.index')}}">Dashboard</a></li>
        <li class="active"><a href="{{$routeLink}}">{{$title}}</a></li>
    </ol>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{$title}}</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên khách</th>
                        <th>Loại khách</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ngày tạo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count())
                        @foreach($data AS $item)
                            <tr>
                                <th scope="row">{{$item->customer_id}}</th>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->customer_group->customer_group_name}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->created_date}}</td>
                                <td>
                                    <a data-title="Cập nhật khách hàng" data-toggle="modal"
                                       data-target="#user-modal"
                                       data-customer_name="{{$item->customer_name}}"
                                       data-mobile="{{$item->mobile}}"
                                       data-email="{{$item->email}}"
                                       data-customer_id="{{$item->customer_id}}"
                                       data-date="{{$item->yob}}-{{$item->mob}}-{{$item->dob}}"
                                       data-customer_group_id="{{$item->customer_group->customer_group_id}}"
                                       data-address="{{$item->address}}">sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>Chưa có dữ liệu</td></tr>
                    @endif
                </tbody>
            </table>
            <ul class="pagination">
                {{$data->links('vendor.pagination.bootstrap-4') }}
            </ul>
        </div>
    </div>

    <p class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal" data-whatever="@mdo">Thêm mới khách hàng</button>
        <button class="btn btn-link" data-toggle="collapse" data-target="#filter">Mở bộ lọc nâng cao @if(!empty($filter))<span class="badge label-danger">{{ count($filter) }}</span>@endif</button>
    </p>
    <!-- modal -->
    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <form action="{{ route('admin.customer.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_name" class="control-label">Tên khách hàng:</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name">
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="control-label">Mobile:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label">Ngày sinh:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="customer_group" class="control-label">Loại khách:</label>
                            <select multiple class="form-control" name="customer_group">
                                @foreach($customerGroup AS $item)
                                    <option value="{{ $item['customer_group_id'] }}">{{ $item['customer_group_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Message:</label>
                            <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <div class="panel panel-info collapse" id="filter">
        <div class="panel-heading">
            <h3 class="panel-title">Bộ lọc <span class="text-lowercase">{{$title}}</span></h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.customer.index') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{ isset($filter['email']) ? $filter['email'] : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputname3" class="col-sm-2 control-label">Tên khách</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputname3" placeholder="Tên khách" name="customer_name" value="{{ isset($filter['customer_name']) ? $filter['customer_name'] : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputmobile" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputmobile" placeholder="Điện thoại" name="mobile" value="{{ isset($filter['mobile']) ? $filter['mobile'] : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputname3" class="col-sm-2 control-label">Loại khách</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control" name="customer_group_id">
                            @foreach($customerGroup AS $item)
                                <option value="{{ $item['customer_group_id'] }}" @if(isset($filter['customer_group_id']) && $filter['customer_group_id']==$item['customer_group_id']) selected="selected" @endif>{{ $item['customer_group_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<div class="col-sm-offset-2 col-sm-10">--}}
                        {{--<div class="checkbox">--}}
                            {{--<label>--}}
                                {{--<input type="checkbox"> Lọc theo danh sách--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Lọc</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop