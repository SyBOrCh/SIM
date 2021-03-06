@extends ('layouts.master')

@section('head')
<style>
    .table > tbody > tr > td {
         vertical-align: middle !important;
         max-width: 90px;
         overflow: hidden;
    }

    .table > tbody >tr > td.structure {
        max-width: 100px;
        overflow: hidden;
    }

    .table > tbody >tr > td.alpha {
        max-width: 200px;
        overflow: hidden;
    }

    .table > tbody >tr > td.mass {
        max-width: 70px;
        overflow: hidden;
    }

</style>
@endsection

@section ('content')

@include ('layouts.navbar')

<div class="container-mx-auto">
    <div class="title">
        <h1> Compounds of {{ $user->name }} </h1>
    </div>

    <div class="table-responsive">
        <table class="table" style="height: 100%;">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        @if($orderByColumn == 'label' && $orderByMethod == 'asc')
                            <a href="?by=label&order=desc">Label <span class="dropup"><span class="caret"></span></span></a>
                        @elseif($orderByColumn == 'label' && $orderByMethod == 'desc')
                            <a href="?by=label&order=asc">Label <span class="caret"></span></a>
                        @else 
                            <a href="?by=label&order=desc">Label</a>
                        @endif
                    </th>
                    <th colspan="2">NMR</th>
                    <th>R<sub>F</sub></th>
                    <th>IR</th>
                    <th>MP</th>
                    <th colspan="3">HRMS</th>
                    <th colspan="3">Specific Rotation</th>
                    <th>Notes</th>
                </tr>
                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td><sup>1</sup>H</td>
                    <td><sup>13</sup>C</td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> °C </td>
                    <td>Adduct</td>
                    <td>Calculated</td>
                    <td>Found</td>
                    <td>[α]</td>
                    <td>c</td>
                    <td>Solvent</td>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr style="height:100%;" class="info">
                    <td colspan="14" style="text-align:center">
                        <strong title="{{ $project->description }}"> {{ $project->name }} </strong>
                    </td>
                </tr>

                @forelse ($project->compounds as $compound)
                    <tr>
                        <td class="structure"><img src="/{{ $compound->SVGPath }}" height="100" style="margin-top:-10px;"></td>
                        
                        <td><a href="/compounds/{{ $compound->id }}">{{ $compound->label }}</a></td>
                        
                        <td style="padding:0;" class="{{ $compound->H_NMR_data ? 'bg-success' : 'bg-danger' }}">
                            <nmr-data-field
                                id="{{ $compound->id }}"
                                data="{{ $compound->H_NMR_data }}"
                                column="H_NMR_data"
                            ></nmr-data-field>
                        </td>
                        
                        <td style="padding:0;" class="{{ $compound->C_NMR_data ? 'bg-success' : 'bg-danger' }}">
                             <nmr-data-field
                                id="{{ $compound->id }}"
                                data="{{ $compound->C_NMR_data }}"
                                column="C_NMR_data"
                            ></nmr-data-field>
                        </td>

                        <td style="padding:0;" class="{{ $compound->retention ? 'bg-success' : 'bg-danger' }}">
                            <retention-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->retention }}" 
                                column="retention"
                            ></retention-field>
                        </td>

                        <td style="padding:0;" class="{{ $compound->infrared ? 'bg-success' : 'bg-danger' }}">
                            <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->infrared }}" 
                                column="infrared"
                            ></text-field>

                        </td>

                        @if ($compound->melting_point == "@")
                            <td style="background-color: #F8F8F8"></td>
                        @else
                            <td style="padding:0;" class="{{ $compound->melting_point ? 'bg-success' : 'bg-danger' }}">
                                <text-field 
                                    id="{{ $compound->id }}" 
                                    data="{{ $compound->melting_point }}" 
                                    column="melting_point"
                                ></text-field>
                            </td>
                        @endif

                        @if ($compound->mass_adduct == "@")
                             <td style="background-color: #F8F8F8"></td>
                        @else
                             <td class="mass {{ $compound->mass_adduct ? 'bg-success' : 'bg-danger' }}" style="padding:0;">
                                <dropdown-field 
                                    id="{{ $compound->id }}" 
                                    data="{{ $compound->mass_adduct }}" 
                                    column="mass_adduct"
                                ></dropdown-field>
                            </td>
                        @endif

                        @if ($compound->mass_calculated == "@")
                            <td style="background-color: #F8F8F8"></td>
                        @else 
                            <td class="mass {{ $compound->mass_calculated ? 'bg-success' : 'bg-danger' }}" style="padding:0;">
                                <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->mass_calculated }}" 
                                column="mass_calculated"
                            ></text-field>
                            </td>
                        @endif

                        @if ($compound->mass_measured == "@")
                            <td style="background-color: #F8F8F8"></td>
                        @else 
                            <td class="mass {{ $compound->mass_measured ? 'bg-success' : 'bg-danger' }}" style="padding:0;">
                                <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->mass_measured }}" 
                                column="mass_measured"
                            ></text-field>
                            </td>
                        @endif
                        
                        @if ($compound->alpha_value == "@")
                            <td style="background-color: #F8F8F8"></td>
                            <td style="background-color: #F8F8F8"></td>
                            <td style="background-color: #F8F8F8"></td>
                        @else
                            <td class="alpha {{ $compound->alpha_value ? 'bg-success' : 'bg-danger' }}" style="padding:0;">
                                <dropdown-text-field
                                    id="{{ $compound->id }}"
                                    dropdown_data="{{ $compound->alpha_sign }}"
                                    dropdown_column="alpha_sign"
                                    text_data="{{ $compound->alpha_value }}"
                                    text_column="alpha_value"
                                ></dropdown-text-field>
                            </td>

                            <td style="padding:0;" class="{{ $compound->alpha_concentration ? 'bg-success' : 'bg-danger' }}">
                                <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->alpha_concentration }}" 
                                column="alpha_concentration"
                            ></text-field>
                            </td>

                            <td style="padding:0;" class="{{ $compound->alpha_solvent ? 'bg-success' : 'bg-danger' }}">
                                <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->alpha_solvent }}" 
                                column="alpha_solvent"
                            ></text-field>
                            </td>
                        @endif

                        <td style="padding:0;">
                            <text-field 
                                id="{{ $compound->id }}" 
                                data="{{ $compound->notes }}" 
                                column="notes"
                            ></text-field>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" style="text-align:center;">
                            <br>
                            Hey there!
                            <br>
                            It looks like you don't have any compounds in this project yet.
                            <br>
                            <a href="/compounds/new"><strong>Click here to add your first</strong></a>
                            <br>
                            <br>
                        </td>
                    </tr>
                @endforelse
                
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
