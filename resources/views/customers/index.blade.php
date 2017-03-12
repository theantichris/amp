@extends('spark::layouts.app')

@section('content')
    <div class="spark-screen container">
        <div class="row">

            <div class="col-md-4">
                @include('customers.sidebar')
            </div>

            <div class="col-md-8">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active">
                        @include('customers.list')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection