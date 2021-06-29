<div class="tab-component">
    <div class="main-info">
        <form action="" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="email_id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
            <input type="hidden" name="email_title" value="@if (isset($main)){{ $main->title }}@endif">
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="email_subject">Subject</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="email_subject"
                            value="@if (isset($main)){{ $main->subject }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="email_body">Body</label>
                        <textarea class="form-control n-b-r h-px-140"
                            name="email_body">@if (isset($main)){{ $main->body }}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-grad btn-save-email w-100 n-b-r">Save Email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>