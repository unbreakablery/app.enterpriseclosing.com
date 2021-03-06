<div class="tab-component">
    <div class="main-info">
        <input type="hidden" name="o-id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
        <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="account-name">Account Name</label>
                    <input class="form-control n-b-r"
                            type="text"
                            id="account-name"
                            name="account-name"
                            value="@if (isset($main)){{ $main->account_name }}@endif"
                    />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="annual-report">Annual Report</label>
                    <input class="form-control n-b-r"
                            type="text"
                            id="annual-report"
                            name="annual-report"
                            value="@if (isset($main)){{ $main->annual_report }}@endif"
                    />
                </div>
            </div>
        </div>
        <div class="row mt-0 ml-0 mr-0 pl-1 pr-1">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="org-hooks">Organisational Hooks</label>
                    <textarea class="form-control h-px-140 n-b-r" id="org-hooks" name="org-hooks" rows="5">@if (isset($main)){{ $main->org_hooks }}@endif</textarea>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="additional-nuggets">Additional Nuggets</label>
                    <textarea class="form-control h-px-140 n-b-r" id="additional-nuggets" name="additional-nuggets" rows="5">@if (isset($main)){{ $main->additional_nuggets }}@endif</textarea>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="pr-articles">PR / Articles</label>
                    <textarea class="form-control h-px-100 n-b-r"
                                id="pr-articles"
                                name="pr-articles"
                                rows="5">@if (isset($main)){{ $main->pr_articles }}@endif</textarea>
                </div>
                <div class="row ml-0 mr-0 mb-3 pl-1 task-section action-group justify-content-end">
                    <button type="button" class="btn btn-grad text-uppercase btn-upload-persons-modal mr-1">
                        <i class="bi bi-upload"></i>
                    </button>
                    <button type="button" class="btn btn-grad text-uppercase btn-download-persons mr-1">
                        <i class="bi bi-download"></i>
                    </button>
                    <button type="button" class="btn btn-grad text-uppercase btn-add-row">
                        Add Row
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive table-wrapper mt-0 p-special-1">
        <div class="persons-table-wrapper border-bottom border-white">
            <table class="table table-hover w-100 mb-0" id="persons-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left no-sort" width="95">First Name</th>
                        <th scope="col" class="text-left no-sort" width="95">Last Name</th>
                        <th scope="col" class="text-left no-sort">Title</th>
                        <th scope="col" class="text-left no-sort" width="100">Phone</th>
                        <th scope="col" class="text-left no-sort" width="100">Mobile</th>
                        <th scope="col" class="text-left no-sort" width="60">Email</th>
                        <th scope="col" class="text-left no-sort" width="60">Calls</th>
                        <th scope="col" class="text-left no-sort" width="65">Result</th>
                        <th scope="col" class="text-left no-sort" width="102">LI Connected</th>
                        <th scope="col" class="text-left no-sort">Notes</th>
                        <th scope="col" class="text-left no-sort" width="80">LI Address</th>
                        <th scope="col" class="text-left no-sort" width="35"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($persons) && count($persons) > 0)
                        @foreach ($persons as $person)
                            <x-outbound-usertable-row :person="$person" />
                        @endforeach
                    @else
                        <tr id="no-data-row">
                            <td class="text-center text-white" colspan="12">No Contact Info</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row task-section justify-content-end col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
            <a class="text-danger n-b-r text-uppercase a-btn-remove-account">
                Remove This Account
            </a>
        </div>
    </div>    
</div>