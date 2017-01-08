@extends('spark::layouts.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        Manage Your Customers
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
