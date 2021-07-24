<div class="users-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-bold mt-2 mr-4">User Management</h3>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12">
        <div class="table-responsive table-wrapper users-table-wrapper mb-4">
            <table class="table table-black w-100" id="users-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="no-sort pl-2 pr-2">Name</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Email</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Role</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Active</th>
                        <th scope="col" class="no-sort pl-2 pr-2" width="160">Created At</th>
                        <th scope="col" class="no-sort pl-2 pr-2" width="160">Updated At</th>
                        <th scope="col" class="text-center" width="93">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr data-id="{{ $user->id }}">
                        <td class="text-white pl-2 pr-2">{{ $user->first_name . ' ' . $user->last_name }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->email }}</td>
                        <td class="text-white pl-2 pr-2">{{ getUserRoleName($user->role) }}</td>
                        <td class="text-white pl-2 pr-2 {{ getUserActiveClass($user->active) }}">{{ getUserActiveName($user->active) }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->created_at }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->updated_at }}</td>
                        <td class="text-center text-white">
                            <button type="button" class="btn btn-sm btn-success n-b-r btn-active-user" title="Active User" @if($user->active){{ 'disabled' }}@endif>
                                <i class="bi bi-person-fill"></i>
                            </button><button type="button" class="btn btn-sm btn-secondary n-b-r btn-inactive-user" title="Inactive User" @if(!$user->active){{ 'disabled' }}@endif>
                                <i class="bi bi-person"></i>
                            </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-user" title="Remove User">
                                <i class="bi bi-person-x"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="delete-account-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="delete-account-modal-header-title">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-4 mb-4 pl-4 pr-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="">Are you sure you want to delete this account?</label>
                        </div>
                        <div class="form-group mb-0">
                            <label class="mb-0">All the data on this account will be lost if you continue.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-grad" data-dismiss="modal">No, I don’t want to cancel this account</button>
                <button type="button" class="btn btn-modal-close" id="btn-delete-account">Yes, please cancel this account</button>
            </div>
        </div>
    </div>
</div>