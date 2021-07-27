<div class="assessments-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-normal mt-2 mr-4">Skills</h3>
    </div>

    <div class="d-flex justify-content-left">
        <div class="col-{{ 3 + count($dates) }} table-wrapper mt-2 mb-4 pl-0 pr-4">
            <div class="assessments-table-wrapper table-responsive border-bottom border-white">
                <table class="table table-hover table-bordered w-100 mb-0" id="assessments-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="no-sort pl-2 pr-2" width="300">Skills</th>
                            @foreach ($dates as $d)
                            <th scope="col" class="text-center no-sort pl-2 pr-2">{{ date('M Y', strtotime($d)) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($groups) && count($groups) > 0)
                        @foreach ($groups as $g)
                            <tr>
                                <td class="text-white font-weight-bolder pl-2 pr-2">
                                    {{ $g->name }}
                                </td>
                                <td colspan="{{ count($dates) }}">&nbsp;</td>
                            </tr>
                            @foreach ($assessments as $a)
                                @if ($a->parent_skill_id == $g->id)
                                    <tr>
                                        <td class="text-white pl-2 pr-2">
                                            {{ $a->skill_name }}
                                        </td>
                                        @foreach ($dates as $d)
                                        <td class="text-right text-white align-middle"
                                            data-parent-skill-id="{{ $a->parent_skill_id }}"
                                            data-skill-id="{{ $a->skill_id }}"
                                            data-date="{{ $d }}">
                                            <div class="input-group">
                                                <input type="number"
                                                    class="form-control text-right data-cell {{ getAssessmentClass($a->assessments[$d]) }}"
                                                    name="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                    placeholder="Assessment value..."
                                                    aria-label="Assessment value..."
                                                    aria-describedby="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                    value="{{ round($a->assessments[$d]) }}"
                                                    min="0"
                                                    max="100"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text n-b-r {{ getAssessmentClass($a->assessments[$d]) }}" id="assessment_{{ $a->skill_id }}_{{ $d }}">%</span>
                                                </div>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td class="text-white font-weight-bolder pl-2 pr-2">
                                    {{ $g->name . ' Performance' }}
                                </td>
                                @foreach ($dates as $d)
                                <td class="text-right text-white align-middle"
                                    data-parent-skill-id=""
                                    data-skill-id="{{ $g->id }}"
                                    data-date="{{ $d }}">
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control text-right data-cell-average font-weight-bolder {{ getAssessmentClass($g->assessments[$d]) }}"
                                            name="assessment_{{ $g->id }}_{{ $d }}"
                                            placeholder="Assessment value..."
                                            aria-label="Assessment value..."
                                            aria-describedby="assessment_{{ $g->id }}_{{ $d }}"
                                            value="{{ round($g->assessments[$d]) }}"
                                            readonly/>
                                        <div class="input-group-append">
                                            <span class="input-group-text n-b-r {{ getAssessmentClass($g->assessments[$d]) }}" id="assessment_{{ $g->id }}_{{ $d }}">%</span>
                                        </div>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="{{ count($dates) + 1 }}">&nbsp;</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-white font-weight-bolder pl-2 pr-2">Total Performance</td>
                            @foreach ($dates as $d)
                                @php
                                    $sum = 0;
                                    $cnt = 0;
                                @endphp
                                @foreach ($groups as $g)
                                    @php
                                        $sum += $g->assessments[$d];
                                        $cnt++;
                                    @endphp
                                @endforeach
                                @php
                                    $avg = ($cnt == 0) ? 0 : round($sum / $cnt);
                                @endphp
                                <td class="text-right text-white align-middle"
                                    data-date="{{ $d }}">
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control text-right font-weight-bolder {{ getAssessmentClass($avg) }}"
                                            name="assessment_total_avgerage_{{ $d }}"
                                            placeholder="Assessment value..."
                                            aria-label="Assessment value..."
                                            aria-describedby="assessment_total_avgerage_{{ $d }}"
                                            value="{{ $avg }}"
                                            readonly/>
                                        <div class="input-group-append">
                                            <span class="input-group-text n-b-r {{ getAssessmentClass($avg) }}" id="assessment_total_avgerage__{{ $d }}">%</span>
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @else
                        <tr id="no-data-row">
                            <td class="text-center text-white" colspan="{{ count($dates) + 1 }}">No Skills For Assessment</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>