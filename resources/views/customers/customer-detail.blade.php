<customer-detail :customer-id="1" inline-template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Account Number</div>
                        <div>@{{ customer.account_number }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Company Name</div>
                        <div>@{{ customer.company_name }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Contact Name</div>
                        <div>@{{ customer.contact_name }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Contact Email</div>
                        <div>@{{ customer.contact_email }}</div>
                    </div>
                </div>

                <div class="row" v-show="customer.contact_phone">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Contact Phone</div>
                        <div>@{{ customer.contact_phone }}</div>
                    </div>
                </div>

                <div class="row" v-show="customer.address1">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Address</div>
                        <div>@{{ customer.address1 }}</div>
                    </div>
                </div>

                <div class="row" v-show="customer.address2">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Address Line 2</div>
                        <div>@{{ customer.address2 }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-xs-4" v-show="customer.city">
                        <div class="detail-label">City</div>
                        <div>@{{ customer.city }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-xs-4" v-show="customer.state">
                        <div class="detail-label">State</div>
                        <div>@{{ customer.state }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-xs-4" v-show="customer.zip">
                        <div class="detail-label">Zip</div>
                        <div>@{{ customer.zip }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6" v-show="customer.shipping_account_provider">
                        <div class="detail-label">Shipping Account Provider</div>
                        <div>@{{ customer.shipping_account_provider }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6" v-show="customer.shipping_account_number">
                        <div class="detail-label">Shipping Account Account Number</div>
                        <div>@{{ customer.shipping_account_number }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</customer-detail>
