<tr data-id="@if (isset($row)){{ $row->id }}@else{{ 0 }}@endif">
    <td class="text-center">
        <input type="number"
                class="form-control w-100"
                name="order"
                placeholder=""
                value="@if (isset($row)){{ $row->order }}@else{{ '0' }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="first-name"
                placeholder=""
                value="@if (isset($row)){{ $row->first_name }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="last-name"
                placeholder=""
                value="@if (isset($row)){{ $row->last_name }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="title"
                placeholder=""
                value="@if (isset($row)){{ $row->title }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="email"
                placeholder=""
                value="@if (isset($row)){{ $row->email }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="landline"
                placeholder=""
                value="@if (isset($row)){{ $row->landline }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="mobile"
                placeholder=""
                value="@if (isset($row)){{ $row->mobile }}@endif"
        />
    </td>
    <td class="text-center">
        <select name="role" class="form-control w-100">
            @foreach ($roles as $key => $role)
                <option
                    value="{{ $role['value'] }}"
                    @if((isset($row) && $row->role == $role['value']) || $key == 'default'){{ 'selected' }}@endif
                >
                    {{ $role['name'] }}
                </option>
            @endforeach
        </select>
    </td>
    <td class="text-center">
        <select name="engagement" class="form-control w-100">
            @foreach ($engagements as $key => $engagement)
                <option
                    value="{{ $engagement['value'] }}"
                    @if((isset($row) && $row->engagement == $engagement['value']) || $key == 'default'){{ 'selected' }}@endif
                >
                    {{ $engagement['name'] }}
                </option>
            @endforeach
        </select>
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="notes"
                placeholder=""
                value="@if (isset($row)){{ $row->notes }}@endif"
        />
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger btn-remove-orgchart-row n-b-r" title="Remove Row">
            <i class="bi bi-x"></i>
        </button>
    </td>
</tr>