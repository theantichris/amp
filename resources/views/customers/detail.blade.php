@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Customer
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div>Account Number</div>
                                <div>{{ $customer->accountNumber }}</div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div>Company Name</div>
                                <div>{{ $customer->companyName }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div>Contact Name</div>
                                <div>{{ $customer->contactName }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div>Contact Email</div>
                                <div>{{ $customer->contactEmail }}</div>
                            </div>
                        </div>

                        @if ($customer->contactPhone )
                            <div class="row">
                                <div class="col-xs-12">
                                    <div>Contact Phone</div>
                                    <div>{{ $customer->contactPhone }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($customer->address1 )
                            <div class="row">
                                <div class="col-xs-12">
                                    <div>Address</div>
                                    <div>{{ $customer->address1 }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($customer->address2 )
                            <div class="row">
                                <div class="col-xs-12">
                                    <div>Address Line 2</div>
                                    <div>{{ $customer->address2 }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            @if ($customer->city)
                                <div class="col-xs-12 col-xs-4">
                                    <div>City</div>
                                    <div>{{ $customer->city }}</div>
                                </div>
                            @endif

                            @if($customer->state)
                                <div class="col-xs-12 col-xs-4">
                                    <div>State</div>
                                    <div>{{ $customer->state }}</div>
                                </div>
                            @endif

                            @if($customer->zip)
                                <div class="col-xs-12 col-xs-4">
                                    <div>Zip</div>
                                    <div>{{ $customer->zip }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($customer->shippingAccountProvider)
                                <div class="col-xs-12 col-md-6">
                                    <div>Shipping Account Provider</div>
                                    <div>{{ $customer->shippingAccountProvider }}</div>
                                </div>
                            @endif
                            @if ($customer->shippingAccountAccountNumber)
                                <div class="col-xs-12 col-md-6">
                                    <div>Shipping Account AccountNumber</div>
                                    <div>{{ $customer->shippingAccountAccountNumber }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
