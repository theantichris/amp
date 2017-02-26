@extends('spark::layouts.app')

@section('content')
    <!--suppress HtmlUnknownTarget -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/customers/add" title="Add customer" class="btn btn-primary">Add</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <sorted-list :columns="['accountNumber', 'companyName', 'contactName', 'contactEmail']"
                                             :url="'/api/customers'"
                                             :default-sort-key="'accountNumber'"></sorted-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
