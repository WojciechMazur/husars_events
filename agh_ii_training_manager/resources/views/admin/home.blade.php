@extends('layouts.admin')

@section('content')
<div class="container">
    <div id="modal">
        <div id="modal-content"></div>
    </div>
    <div class="row">
        @include('admin.navbar')

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div id="admin-content" class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
