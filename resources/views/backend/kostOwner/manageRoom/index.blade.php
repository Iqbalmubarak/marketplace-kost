@extends('layouts.kostOwner.main')

@section('css')
<!-- FooTable -->
<link href="{{ asset('templates/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Manage Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">


    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label" for="price">Price</label>
                    <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label" for="quantity">Quantity</label>
                    <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" selected>Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>

                                <th data-toggle="true">Kamar</th>
                                <th data-hide="phone">Harga</th>
                                <th data-hide="phone">Kost</th>
                                <th data-hide="phone">Luas Kamar</th>
                                <th data-hide="phone">Status</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Example product 1
                                </td>
                                <td>
                                    Model 1
                                </td>
                                <td>
                                    Model 1
                                </td>
                                <td>
                                    Model 1
                                </td>
                                <td>
                                    <span class="label label-primary">Enable</span>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <ul class="pagination float-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('script')
<!-- FooTable -->
<script src="{{ asset('templates/js/plugins/footable/footable.all.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $('.footable').footable();

        function create_seller_table_row(item) {
            var row = $('<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>');
            return row;
        }

        $.ajax({
            url: "{{url('api/kost')}}?data=all&&user={{Auth::user()->kostOwner->id}}",
            data: {},
            success: function (data) {
                $.each(data, function (index, item) {
                    var row = create_seller_table_row(item);
                    $('table tbody').append(row);
                });

                $('table').trigger('footable_initialize');
            },
            error: function (xhr, statusText, error) {
                alert("Error! Could not retrieve the data.");
            }
        });

    });

</script>
@endsection
