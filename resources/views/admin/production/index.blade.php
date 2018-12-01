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
            var product_category_id = button.data('product_category_id')
            var product_name = button.data('product_name')
            var product_id = button.data('product_id')
            var product_desc = button.data('product_desc')
            var title = 'Thêm mới'
            title = button.data('title')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text(title)
            modal.find('.modal-body input[name="product_id"]').val(product_id)
            modal.find('.modal-body input[name="product_name"]').val(product_name)
            modal.find('.modal-body option[value="'+product_category_id+'"]').attr("selected","selected");
            modal.find('.modal-body textarea[name="product_desc"]').html(product_desc)
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
                        <th>ID mẫu</th>
                        <th>Tên mẫu</th>
                        <th>Mô tả mẫu</th>
                        <th>Số lượng</th>
                        <th>Ngày tạo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count())
                        @foreach($data AS $item)
                            <tr>
                                <th scope="row">{{$item->product_id}}</th>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->product_desc}}</td>
                                <td>{{count($item->product_details->toArray())}}</td>
                                <td>{{$item->product_create_date}}</td>
                                <td>
                                    <a data-title="Cập nhật mẫu" data-toggle="modal"
                                       data-target="#user-modal"
                                       data-product_id="{{$item->product_id}}"
                                       data-product_category_id="{{$item->product_category_id}}"
                                       data-product_name="{{$item->product_name}}"
                                       data-product_desc="{{$item->product_desc}}">Sửa</a>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal" data-whatever="@mdo">Thêm mới mẫu</button>
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
                <form action="{{ route('admin.production.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product_name" class="control-label">Tên mẫu:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                            <input type="hidden" class="form-control" id="product_id" name="product_id">
                        </div>
                        <div class="form-group">
                            <label for="customer_group" class="control-label">Loại sản phẩm:</label>
                            <select class="form-control" name="product_category_id">
                                @foreach($productCategory AS $item)
                                    <option value="{{ $item['product_category_id'] }}">{{ $item['category_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_desc" class="control-label">Mô tả mẫu:</label>
                            <textarea class="form-control" id="product_desc" name="product_desc"></textarea>
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
            <form class="form-horizontal" action="{{ route('admin.production.index') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên mẫu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Tên mẫu" name="product_name" value="{{ isset($filter['product_name']) ? $filter['product_name'] : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputname3" class="col-sm-2 control-label">Loại sản phẩm</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control" name="product_category_id">
                            @foreach($productCategory AS $item)
                                <option value="{{ $item['product_category_id'] }}" @if(isset($filter['product_category_id']) && $filter['product_category_id']==$item['product_category_id']) selected="selected" @endif>{{ $item['category_name'] }}</option>
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