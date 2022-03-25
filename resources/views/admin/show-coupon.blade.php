@extends('admin.dashboard')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            SHOW GIFTCODE
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Giftcode ID</th>
                        <th>Giftcode name</th>
                        <th>Giftcode type</th>
                        <th>Giftcode times</th>
                        <th>Giftcode discount</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userData as $key => $values )
                    <tr>
                        <td>{{$values->giftcode_id}}</td>
                        <td>{{$values->giftcode_name}}</td>
                        <td>
                            @if($values->giftcode_condidtion == 1)
                            Discount by percent
                            @else
                            Direct discount
                            @endif
                        </td>
                        <td>{{$values->giftcode_times}}</td>
                        <td>
                            @if($values->giftcode_condidtion == 1)
                            {{$values->giftcode_discount}} %
                            @else
                            {{number_format($values->giftcode_discount).' '. 'VND'}}
                            @endif
                        </td>
                        <td>
                            <form action="/delete-coupon?id={{$values->giftcode_id}}" method="POST">
                                @csrf
                                {{@method_field('delete')}}
                                <button onclick="return confirm('Are you sure to delete?')" class="active"><i class="fa fa-times text-danger text"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection