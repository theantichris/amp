@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('customers.sidebar')

            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Customer
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="detail-group col-xs-12 col-md-6">
                                <div class="detail-label">Account Number</div>
                                <div>{{ $customer->getAccountNumber() }}</div>
                            </div>

                            <div class="detail-group col-xs-12 col-md-6">
                                <div class="detail-label">Company Name</div>
                                <div>{{ $customer->getCompanyName() }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="detail-group col-xs-12">
                                <div class="detail-label">Contact Name</div>
                                <div>{{ $customer->getContactName() }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="detail-group col-xs-12">
                                <div class="detail-label">Contact Email</div>
                                <div>{{ $customer->getContactEmail() }}</div>
                            </div>
                        </div>

                        @if ($customer->getContactPhone() )
                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Contact Phone</div>
                                    <div>{{ $customer->getContactPhone() }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($customer->getAddress1() )
                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Address</div>
                                    <div>{{ $customer->getAddress1() }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($customer->getAddress2() )
                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Address Line 2</div>
                                    <div>{{ $customer->getAddress2() }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            @if ($customer->getCity())
                                <div class="detail-group col-xs-12 col-xs-4">
                                    <div class="detail-label">City</div>
                                    <div>{{ $customer->getCity() }}</div>
                                </div>
                            @endif

                            @if($customer->getState())
                                <div class="detail-group col-xs-12 col-xs-4">
                                    <div class="detail-label">State</div>
                                    <div>{{ $customer->getState() }}</div>
                                </div>
                            @endif

                            @if($customer->getZip())
                                <div class="detail-group col-xs-12 col-xs-4">
                                    <div class="detail-label">Zip</div>
                                    <div>{{ $customer->getZip() }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($customer->getShippingAccountProvider())
                                <div class="detail-group col-xs-12 col-md-6">
                                    <div class="detail-label">Shipping Account Provider</div>
                                    <div>{{ $customer->getShippingAccountProvider() }}</div>
                                </div>
                            @endif
                            @if ($customer->getShippingAccountNumber())
                                <div class="detail-group col-xs-12 col-md-6">
                                    <div class="detail-label">Shipping Account AccountNumber</div>
                                    <div>{{ $customer->getShippingAccountNumber() }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
