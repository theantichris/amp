@extends('spark::layouts.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <div class="dashboard row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            <div class="dashboard__icon">
                                <a class="dashboard__link" href="customer">
                                    <div class="dashboard__image"><i class="fa fa-users"></i></div>
                                    <div class="dashboard__text">Customers</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection
