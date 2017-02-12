@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        <sorted-list :columns="['accountNumber', 'companyName', 'contactName', 'contactEmail']"
                                       :url="'/api/customer'"
                                       :sort-key="'accountNumber'"></sorted-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
