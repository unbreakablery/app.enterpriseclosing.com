<tr data-id="@if (isset($person)){{ $person->id }}@else{{ 0 }}@endif">
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="first-name"
                placeholder="First Name..."
                value="@if (isset($person)){{ $person->first_name }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="last-name"
                placeholder="Last Name..."
                value="@if (isset($person)){{ $person->last_name }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="title"
                placeholder="Title..."
                value="@if (isset($person)){{ $person->title }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="phone"
                placeholder="Phone..."
                value="@if (isset($person)){{ $person->phone }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="mobile"
                placeholder="Mobile..."
                value="@if (isset($person)){{ $person->mobile }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="email"
                placeholder="E-Mail..."
                value="@if (isset($person)){{ $person->email }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="calls"
                placeholder="Calls..."
                value="@if (isset($person)){{ $person->calls }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="result"
                placeholder="Result..."
                value="@if (isset($person)){{ $person->result }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="linkedin-connected"
                placeholder="LinkedIn Connected..."
                value="@if (isset($person)){{ $person->li_connected }}@endif"
        />
    </td>
    <td class="center">
        <input type="text"
                class="form-control w-100"
                name="linkedin-address"
                placeholder="LinkedIn Address..."
                value="@if (isset($person)){{ $person->li_address }}@endif"
        />
    </td>
    <td class="center">
        <button type="button" class="btn btn-sm btn-danger btn-remove-row">Remove</button>
    </td>
</tr>