@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        <customer-list></customer-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
