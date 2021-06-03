<tr data-id="@if (isset($person)){{ $person->id }}@else{{ 0 }}@endif">
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="first-name"
                placeholder=""
                value="@if (isset($person)){{ $person->first_name }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="last-name"
                placeholder=""
                value="@if (isset($person)){{ $person->last_name }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="title"
                placeholder=""
                value="@if (isset($person)){{ $person->title }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="phone"
                placeholder=""
                value="@if (isset($person)){{ $person->phone }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="mobile"
                placeholder=""
                value="@if (isset($person)){{ $person->mobile }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="email"
                placeholder=""
                value="@if (isset($person)){{ $person->email }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="number"
                class="form-control w-100 text-right"
                name="calls"
                min="0"
                placeholder=""
                value="@if (isset($person)){{ $person->calls }}@else{{ 0 }}@endif"
        />
    </td>
    <td class="text-center">
        <select name="result" class="form-control w-100">
            <option value=""></option>
            <option value="Do Not Call" @if (isset($person) && $person->result == 'Do Not Call'){{ 'selected' }}@endif>Do Not Call</option>
            <option value="Bad Number" @if (isset($person) && $person->result == 'Bad Number'){{ 'selected' }}@endif>Bad Number</option>
            <option value="Not Interested" @if (isset($person) && $person->result == 'Not Interested'){{ 'selected' }}@endif>Not Interested</option>
            <option value="Call Later" @if (isset($person) && $person->result == 'Call Later'){{ 'selected' }}@endif>Call Later</option>
            <option value="Send Info" @if (isset($person) && $person->result == 'Send Info'){{ 'selected' }}@endif>Send Info</option>
            <option value="Info Sent" @if (isset($person) && $person->result == 'Info Sent'){{ 'selected' }}@endif>Info Sent</option>
            <option value="Follow Up Booked" @if (isset($person) && $person->result == 'Follow Up Booked'){{ 'selected' }}@endif>Follow Up Booked</option>
            <option value="Demo Booked" @if (isset($person) && $person->result == 'Demo Booked'){{ 'selected' }}@endif>Demo Booked</option>
        </select>
    </td>
    <td class="text-center">
        <select name="linkedin-connected" class="form-control w-100">
            <option value="Not Sent" @if (isset($person) && $person->li_connected == 'Not Sent'){{ 'selected' }}@endif>Not Sent</option>
            <option value="Sent" @if (isset($person) && $person->li_connected == 'Sent'){{ 'selected' }}@endif>Sent</option>
            <option value="Connect" @if (isset($person) && $person->li_connected == 'Connect'){{ 'selected' }}@endif>Connect</option>
        </select>
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="notes"
                placeholder=""
                value="@if (isset($person)){{ $person->notes }}@endif"
        />
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="linkedin-address"
                placeholder=""
                value="@if (isset($person)){{ $person->li_address }}@endif"
        />
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger btn-remove-row n-b-r">
            <i class="bi bi-x"></i>
        </button>
    </td>
</tr>