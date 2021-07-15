<div class="users-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-bold mt-2 mr-4">User Management</h3>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12">
        <div class="table-responsive table-wrapper users-table-wrapper mb-4">
            <table class="table w-100" id="users-table">
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
                            <td class="text-white pl-2 pr-2">{{ getRoleName($user->role) }}</td>
                            <td class="text-white pl-2 pr-2 {{ getActiveClass($user->active) }}">{{ getActiveName($user->active) }}</td>
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