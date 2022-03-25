@extends('admin.Dashboard')
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            ORDER LIST
        </div>
        <div class="row w3-res-tb">

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID Order</th>
                        <th>User</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>View orders details</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach($order as $key => $values)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$values->ord_code}}</td>
                        <td>{{$values->ord_name}}</td>
                        @if($values->ord_status == 1)
                        <td>Not confirm yet</td>
                        @else
                        <td>Has confirmed</td>
                        @endif
                        <td>{{$values->ord_created}}</td>
                        <td>
                            <a href="/view-order?code={{$values->ord_code}}"><i class="fa fa-eye text-success text-active" style="font-size: large;"></i></a>
                            </a>
                        </td>
                        <form action="/accept-order?code={{$values->ord_code}}" method="post">
                            @csrf
                            {{@method_field('post')}}
                            @if($values->ord_status == 1)
                            <td><button type="submit" class="btn btn-success">Accept orders</button></td>
                            @else
                            <td><i class="fa fa-check" style="font-size: large; color:green;"></i></td>
                            @endif
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

