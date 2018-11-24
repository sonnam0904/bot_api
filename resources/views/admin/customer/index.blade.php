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
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên khách</th>
                        <th>Loại khách</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count())
                        @foreach($data AS $item)
                            <tr>
                                <th scope="row">{{$item->customer_id}}</th>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->customer_group->customer_group_name}}</td>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->address}}</td>
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
        <button class="btn btn-link" data-toggle="collapse" data-target="#filter">Mở bộ lọc nâng cao</button>
    </p>
    <!-- modal -->
    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->


    <div class="panel panel-info collapse" id="filter">
        <div class="panel-heading">
            <h3 class="panel-title">Bộ lọc <span class="text-lowercase">{{$title}}</span></h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputname3" class="col-sm-2 control-label">Tên khách</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputname3" placeholder="Tên khách" name="customer_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputmobile" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputmobile" placeholder="Điện thoại" name="mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputname3" class="col-sm-2 control-label">Loại khách</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control">
                            <option>Khách vip</option>
                            <option>Khách quen</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Lọc theo danh sách
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Lọc</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop