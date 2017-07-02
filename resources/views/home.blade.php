@extends('spark::layouts.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <div class="dashboard row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            <h3>Resources</h3>

                            <div class="row">
                                <div class="dashboard__icon col-md-2">
                                    <a class="dashboard__link" title="Customers" href="customers">
                                        <div class="dashboard__image"><i class="fa fa-vcard"></i></div>
                                        <div class="dashboard__text">Customers</div>
                                    </a>
                                </div>

                                <div class="dashboard__icon col-md-2">
                                    <a class="dashboard__link" title="Machine Profiles" href="machine-profiles">
                                        <div class="dashboard__image"><i class="fa fa-server"></i></div>
                                        <div class="dashboard__text">Machine Profiles</div>
                                    </a>
                                </div>
                            </div>

                            <h3>Projects</h3>

                            <div class="row">
                                <div class="dashboard__icon col-md-2">
                                    <a class="dashboard__link" title="Projects" href="">
                                        <div class="dashboard__image"><i class="fa fa-file"></i></div>
                                        <div class="dashboard__text">Projects</div>
                                    </a>
                                </div>

                                <div class="dashboard__icon col-md-2">
                                    <a class="dashboard__link" title="Materials" href="materials">
                                        <div class="dashboard__image"><i class="fa fa-cubes"></i></div>
                                        <div class="dashboard__text">Materials</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection
