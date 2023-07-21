@extends('layouts.admin')
@section('content')

<!-- <style>
    .bg-gold {
        background-color: #DDA73C;
    }
</style> -->

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        @can('dash_board_member_info')
                        <div class="{{ $settings1['column_class'] }}">

                            <div class="card text-white bg-primary">

                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <div>{{ $settings1['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <div>{{ $settings2['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings3['total_number']) }}</div>
                                    <div>{{ $settings3['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        @endcan
                        @can('dash_board_venue_info')
                        <div class="{{ $chart4->options['column_class'] }}">
                            <h3>{!! $chart4->options['chart_title'] !!}</h3>
                            {!! $chart4->renderHtml() !!}
                        </div>
                        @endcan
                        @can('dash_board_recent_member')
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings5['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings5['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings5['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings5['data'] as $entry)
                                    <tr>
                                        @foreach($settings5['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endcan
                        @can('dash_board_recent_appointment_booking')
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings6['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings6['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings6['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings6['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings6['data'] as $entry)
                                    <tr>
                                        @foreach($settings6['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings6['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endcan
                        @can('dash_board_recent_appointment_booking')
                        <div class="{{ $settings7['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings7['total_number']) }}</div>
                                    <div>{{ $settings7['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart8->options['column_class'] }}">
                            <h3>{!! $chart8->options['chart_title'] !!}</h3>
                            {!! $chart8->renderHtml() !!}
                        </div>
                        <div class="{{ $chart9->options['column_class'] }}">
                            <h3>{!! $chart9->options['chart_title'] !!}</h3>
                            {!! $chart9->renderHtml() !!}
                        </div>
                        <div class="{{ $chart10->options['column_class'] }}">
                            <h3>{!! $chart10->options['chart_title'] !!}</h3>
                            {!! $chart10->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings11['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings11['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings11['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings11['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings11['data'] as $entry)
                                    <tr>
                                        @foreach($settings11['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings11['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $settings12['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings12['total_number']) }}</div>
                                    <div>{{ $settings12['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings13['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings13['total_number']) }}</div>
                                    <div>{{ $settings13['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings14['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings14['total_number']) }}</div>
                                    <div>{{ $settings14['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings15['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings15['total_number']) }}</div>
                                    <div>{{ $settings15['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings16['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings16['total_number']) }}</div>
                                    <div>{{ $settings16['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings17['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings17['total_number']) }}</div>
                                    <div>{{ $settings17['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart18->options['column_class'] }}">
                            <h3>{!! $chart18->options['chart_title'] !!}</h3>
                            {!! $chart18->renderHtml() !!}
                        </div>
                        <div class="{{ $chart19->options['column_class'] }}">
                            <h3>{!! $chart19->options['chart_title'] !!}</h3>
                            {!! $chart19->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings20['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings20['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings20['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings20['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings20['data'] as $entry)
                                    <tr>
                                        @foreach($settings20['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings20['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endcan
                        @can('dash_board_recent_issue_raised')
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings21['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings21['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings21['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings21['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings21['data'] as $entry)
                                    <tr>
                                        @foreach($settings21['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings21['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endcan
                        <div class="{{ $chart22->options['column_class'] }}">
                            <h3>{!! $chart22->options['chart_title'] !!}</h3>
                            {!! $chart22->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings23['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings23['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings23['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings23['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings23['data'] as $entry)
                                    <tr>
                                        @foreach($settings23['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings23['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $chart24->options['column_class'] }}">
                            <h3>{!! $chart24->options['chart_title'] !!}</h3>
                            {!! $chart24->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings25['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings25['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings25['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings25['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings25['data'] as $entry)
                                    <tr>
                                        @foreach($settings25['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings25['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $chart26->options['column_class'] }}">
                            <h3>{!! $chart26->options['chart_title'] !!}</h3>
                            {!! $chart26->renderHtml() !!}
                        </div>
                        <div class="{{ $chart27->options['column_class'] }}">
                            <h3>{!! $chart27->options['chart_title'] !!}</h3>
                            {!! $chart27->renderHtml() !!}
                        </div>
                        <div class="{{ $chart28->options['column_class'] }}">
                            <h3>{!! $chart28->options['chart_title'] !!}</h3>
                            {!! $chart28->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings29['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings29['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings29['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings29['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings29['data'] as $entry)
                                    <tr>
                                        @foreach($settings29['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings29['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings30['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings30['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings30['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings30['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings30['data'] as $entry)
                                    <tr>
                                        @foreach($settings30['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                            {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                            @foreach($entry->{$key} as $subEentry)
                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                            @endforeach
                                            @else
                                            {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings30['fields']) }}">{{ __('No entries found') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $chart31->options['column_class'] }}">
                            <h3>{!! $chart31->options['chart_title'] !!}</h3>
                            {!! $chart31->renderHtml() !!}
                        </div>
                        <div class="{{ $chart32->options['column_class'] }}">
                            <h3>{!! $chart32->options['chart_title'] !!}</h3>
                            {!! $chart32->renderHtml() !!}
                        </div>
                        <div class="{{ $chart33->options['column_class'] }}">
                            <h3>{!! $chart33->options['chart_title'] !!}</h3>
                            {!! $chart33->renderHtml() !!}
                        </div>
                        <div class="{{ $settings34['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings34['total_number']) }}</div>
                                    <div>{{ $settings34['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart4->renderJs() !!}{!!
$chart8->renderJs() !!}{!! $chart9->renderJs() !!}{!! $chart10->renderJs() !!}{!! $chart18->renderJs() !!}{!!
$chart19->renderJs() !!}{!! $chart22->renderJs() !!}{!! $chart24->renderJs() !!}{!! $chart26->renderJs() !!}{!!
$chart27->renderJs() !!}{!! $chart28->renderJs() !!}{!! $chart31->renderJs() !!}{!! $chart32->renderJs() !!}{!!
$chart33->renderJs() !!}

<script>

</script>
@endsection
