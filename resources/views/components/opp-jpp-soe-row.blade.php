<tr data-id="@if (isset($row)){{ $row->id }}@else{{ 0 }}@endif">
    <td class="text-center">
        <input type="number"
                class="form-control w-100"
                name="no"
                placeholder=""
                value="@if (isset($row)){{ $row->no }}@else{{ '0' }}@endif"
        />
    </td>
    <td class="text-center">
        <select name="task_event" class="form-control w-100">
            <option value=""></option>
            @foreach ($taskEvents as $te)
                <option
                    value="{{ $te->id }}"
                    @if((isset($row) && $row->task_event == $te->id)){{ 'selected' }}@endif
                >
                    {{ $te->o_value }}
                </option>
            @endforeach
        </select>
    </td>
    <td class="text-center">
        <div class="d-flex">
            @if (!empty($ownships))
                @foreach ($ownships as $key => $value)
                    <div class="form-check pt-0">
                        <input type="checkbox"
                                class="form-check-input"
                                name="{{ $key }}"
                                id="{{ $key }}-@if (isset($row)){{ $row->id }}@else{{ '0' }}@endif"
                                @if ($key == 'user_company')
                                    @if (isset($row) && ($row->ownership == 1 || $row->ownership == 3)){{ 'checked' }}@endif
                                @else
                                    @if (isset($row) && ($row->ownership == 2 || $row->ownership == 3)){{ 'checked' }}@endif
                                @endif
                        />
                        <label class="form-check-label" for="{{ $key }}-@if (isset($row)){{ $row->id }}@else{{ '0' }}@endif">{{ $value }}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100 date"
                name="target_date"
                placeholder="dd-mm-yyyy"
                value="@if (isset($row->target_date)){{ date('d-m-Y', strtotime($row->target_date)) }}@endif"
        />
    </td>
    <td class="text-center">
        <select name="completed" class="form-control w-100">
            @foreach ($completes as $key => $c)
                <option
                    value="{{ $c['value'] }}"
                    @if((isset($row) && $row->completed == $c['value']) || $key == 'default'){{ 'selected' }}@endif
                >
                    {{ $c['name'] }}
                </option>
            @endforeach
        </select>
    </td>
    <td class="text-center">
        <input type="text"
                class="form-control w-100"
                name="comments"
                placeholder=""
                value="@if (isset($row)){{ $row->comments }}@endif"
        />
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger btn-remove-jppsoe-row n-b-r" title="Remove Row">
            <i class="bi bi-x"></i>
        </button>
    </td>
</tr>