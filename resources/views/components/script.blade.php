<div class="tab-component">
    <div class="main-info">
        <form action="" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="script_id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
            <input type="hidden" name="script_name" value="@if (isset($main)){{ $main->name }}@endif">
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="script_content">Script Content</label>
                        <textarea class="form-control n-b-r h-px-140"
                            name="script_content">@if (isset($main)){{ $main->content }}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-app-default btn-save-script w-100 n-b-r">Save Script</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>