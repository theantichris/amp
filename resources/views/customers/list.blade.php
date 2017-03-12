<div class="panel panel-default">
    <div class="panel-heading">Customers</div>

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <sorted-list :columns="['accountNumber', 'companyName', 'contactName', 'contactEmail']"
                             :api-url="'/api/customers'"
                             :url="'/customers'"
                             :default-sort-key="'accountNumber'"></sorted-list>
            </div>
        </div>
    </div>
</div>
