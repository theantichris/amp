@extends('spark::layouts.app')

@section('content')
    <customer-management inline-template>
        <div class="spark-screen container">
            <div class="row">

                <div class="col-md-4">
                    <div class="panel panel-default panel-flush">
                        <div class="panel-heading">
                            Customers
                        </div>

                        <div class="panel-body">
                            <div class="spark-settings-stacked-tabs">
                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-list"></i>List
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#form" aria-controls="form" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-plus"></i>Add Customer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            @include('customers.list')
                        </div>

                        <div role="tabpanel" class="tab-pane" id="form">
                            @include('customers.form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </customer-management>
@endsection