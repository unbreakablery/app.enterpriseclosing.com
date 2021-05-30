<div class="tab-component">
    <div class="main-info">
        <input type="hidden" name="o-id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
        <input type="hidden" name="account-name" value="@if (isset($main)){{ $main->account_name }}@endif">
        <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="row ml-0 mr-0 pl-1 pr-1">
                    <label class="col-lg-6 col-md-6 col-sm-6 justify-content-end" for="">
                        Annual Report:
                    </label>
                    <input class="col-lg-6 col-md-6 col-sm-6"
                            type="text"
                            name="annual-report"
                            value="@if (isset($main)){{ $main->annual_report }}@endif"
                    />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="row ml-0 mr-0 pl-1 pr-1">
                    <label class="col-lg-6 col-md-6 col-sm-6 justify-content-end" for="">
                        PR / Articles:
                    </label>
                    <input class="col-lg-6 col-md-6 col-sm-6"
                            type="text"
                            name="pr-articles"
                            value="@if (isset($main)){{ $main->pr_articles }}@endif"
                    />
                </div>
            </div>
        </div>
        <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="row ml-0 mr-0 pl-1 pr-1">
                    <label class="col-lg-6 col-md-6 col-sm-6 justify-content-end" for="">
                        Organisational Hooks:
                    </label>
                    <textarea class="col-lg-6 col-md-6 col-sm-6" name="org-hooks" rows="5">@if (isset($main)){{ $main->org_hooks }}@endif</textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="row ml-0 mr-0 pl-1 pr-1">
                    <label class="col-lg-6 col-md-6 col-sm-6 justify-content-end" for="">
                        Additional Nuggets:
                    </label>
                    <textarea class="col-lg-6 col-md-6 col-sm-6" name="additional-nuggets" rows="5">@if (isset($main)){{ $main->additional_nuggets }}@endif</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive table-wrapper mt-4">
        <div class="row task-section justify-content-end col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
            <button type="button" class="btn btn-app-default n-b-r text-uppercase btn-add-row mr-1">
                Add Row
            </button>
            <button type="button" class="btn btn-danger n-b-r text-uppercase btn-remove-account">
                Remove This Account
            </button>
        </div>
        <div class="persons-table-wrapper">
        <table class="table table-hover w-100 mb-0" id="persons-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center no-sort">First Name</th>
                    <th scope="col" class="text-center no-sort">Last Name</th>
                    <th scope="col" class="text-center no-sort">Title</th>
                    <th scope="col" class="text-center no-sort">Phone</th>
                    <th scope="col" class="text-center no-sort">Mobile</th>
                    <th scope="col" class="text-center no-sort">Email</th>
                    <th scope="col" class="text-center no-sort">Calls</th>
                    <th scope="col" class="text-center no-sort">Result</th>
                    <th scope="col" class="text-center no-sort">LI Connected</th>
                    <th scope="col" class="text-center no-sort">LI Address</th>
                    <th scope="col" class="text-center no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($persons) && count($persons) > 0)
                    @foreach ($persons as $person)
                        <x-outbound-usertable-row :person="$person" />
                    @endforeach
                @else
                    <tr id="no-data-row">
                        <td class="text-center text-white" colspan="11">No Person Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>    
</div>