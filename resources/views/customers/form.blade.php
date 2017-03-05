@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('customers.sidebar')

            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if ($customerId) Edit @else Add @endif
                        Customer
                    </div>

                    <div class="panel-body">
                        <customer-form :customer-id="{{json_encode($customerId)}}"></customer-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
