@extends('admin.dashboard')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            SHOW Catalog
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert" style="color: red">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Catalog ID</th>
                        <th>Catalog Name</th>
                        <th>Catalog Main</th>
                        <th style="width:300px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalog as $UserData)
                    <tr>
                        <td>{{$UserData->catalog_id}}</td>
                        <td>{{$UserData->catalog_name}}</td>
                        <td>{{$UserData->catalog_parent}}</td>
                        <td>
                            <a href="/edit-category?id={{$UserData->catalog_id}}" class="active styling_edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <form action="/delete-category?id={{$UserData->catalog_id}}" method="POST">
                                @csrf
                                {{@method_field('delete')}}
                                <button type="submit" onclick="return confirm('Are you sure to delete?')" class="active"><i class="fa fa-times text-danger text"></i></button>
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