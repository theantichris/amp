<sorted-list :api-url="'/api/customers'" inline-template xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default">
        <div class="panel-heading">Customers</div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped sortable-table">
                        <thead>
                        <tr>
                            <th>Account</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="item in items">
                            <td>
                                <div class="btn-table-align">@{{ item.accountNumber }}</div>
                            </td>
                            <td>
                                <div class="btn-table-align">@{{ item.companyName }}</div>
                            </td>
                            <td>
                                <div class="btn-table-align">@{{ item.contactName }}</div>
                            </td>
                            <td>
                                <div class="btn-table-align">@{{ item.contactEmail }}</div>
                            </td>

                            <td>
                                <a v-bind:href="'/customers/' + item.id">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</sorted-list>