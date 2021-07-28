<div class="users-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-normal mt-2 mr-4">User Management</h3>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12">
        <div class="table-responsive table-wrapper users-table-wrapper border-bottom border-white mb-4">
            <table class="table w-100 mb-0" id="users-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="no-sort pl-2 pr-2">Name</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Email</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Role</th>
                        <th scope="col" class="no-sort pl-2 pr-2">Active</th>
                        <th scope="col" class="no-sort pl-2 pr-2" width="160">Created At</th>
                        <th scope="col" class="no-sort pl-2 pr-2" width="160">Updated At</th>
                        <th scope="col" class="text-center" width="132">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr data-id="{{ $user->id }}"
                        data-username="{{ $user->first_name . ' ' . $user->last_name }}"
                        data-email="{{ $user->email }}"
                        data-userrole="{{ $user->role }}"
                        data-useractive="{{ $user->active }}"
                    >
                        <td class="text-white pl-2 pr-2">{{ $user->first_name . ' ' . $user->last_name }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->email }}</td>
                        <td class="text-white pl-2 pr-2 @if($user->role == 0){{'text-danger'}}@endif">{{ getUserRoleName($user->role) }}</td>
                        <td class="text-white pl-2 pr-2 {{ getUserActiveClass($user->active) }}">{{ getUserActiveName($user->active) }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->created_at }}</td>
                        <td class="text-white pl-2 pr-2">{{ $user->updated_at }}</td>
                        <td class="text-center text-white">
                            <!-- <button type="button" class="btn btn-sm btn-success n-b-r btn-active-user" title="Active User" @if($user->active){{ 'disabled' }}@endif>
                                <i class="bi bi-person-fill"></i>
                            </button><button type="button" class="btn btn-sm btn-secondary n-b-r btn-inactive-user" title="Inactive User" @if(!$user->active){{ 'disabled' }}@endif>
                                <i class="bi bi-person"></i>
                            </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-user" title="Remove User">
                                <i class="bi bi-person-x"></i>
                            </button> -->
                            <button type="button" class="btn btn-sm btn-success btn-edit-user" title="Edit User">
                                <i class="bi bi-person-fill"></i> Edit
                            </button><button type="button" class="btn btn-sm btn-danger btn-remove-user" title="Delete User" @if($user->role == 0){{'disabled'}}@endif>
                                <i class="bi bi-person-x"></i> Delete
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
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 550px">
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
                <button type="button" class="btn btn-grad btn-w-bigger" data-dismiss="modal">No, I don’t want to cancel</button>
                <button type="button" class="btn btn-modal-close btn-w-bigger" id="btn-delete-account">Yes, please cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="edit-account-modal" tabindex="-1" role="dialog" aria-labelledby="edit-account-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-account-modal-header-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Do you want to change this User?</h3>
                <form class="form-inline mt-4" autocomplete="off" method="post">
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Name
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6 h-default-input" name="username" readonly/>
                        <input type="hidden" name="userid" />
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Email
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6 h-default-input" name="email" readonly/>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Role:
                        </label>
                        <select name="role" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($roles as $role => $role_name)
                            <option value="{{ $role }}">{{ $role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Active Status:
                        </label>
                        <select name="active" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-user">Update</button>
            </div>
        </div>
    </div>
</div>