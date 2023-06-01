@extends('layouts.admin')
@section('content')
<div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="fs-2 fw-semibold">Dashboard</div>
          <div class="row">
            @can('dash_board_member_info')
            <div class="col-lg-12">
              <div class="row">
                
                <div class="col-lg-4">
                  <div class="card mb-4 text-white bg-warning-gradient" style="height: 150px">
                	<div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  		<div>
                    		<div class="fs-4 fw-semibold">{{ number_format($settings1['total_number']) }} <span class="fs-6 fw-normal">(-12.4%
                              <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                              </svg>)</span>
                          	</div>
                    		<div>{{ $settings1['chart_title'] }}</div>
                  		</div> 
                        <div class="dropdown">
                          <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                              <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                            </svg>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                        </div>
                	</div>
              	</div>
             </div>
                
                <div class="col-lg-4">
                  <div class="card mb-4 text-white bg-success-gradient" style="height: 150px">
                	<div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  		<div>
                    		<div class="fs-4 fw-semibold">{{ number_format($settings2['total_number']) }} <span class="fs-6 fw-normal">(-12.4%
                              <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                              </svg>)</span>
                          </div>
                    	<div>{{ $settings2['chart_title'] }}</div>
                  	</div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
             </div>
                
                <div class="col-lg-4">
                  <div class="card mb-4 text-white bg-danger-gradient" style="height: 150px">
                	<div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  		<div>
                    		<div class="fs-4 fw-semibold">{{ number_format($settings3['total_number']) }} <span class="fs-6 fw-normal">(-12.4%
                              <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                              </svg>)</span>
                          </div>
                    	<div>{{ $settings3['chart_title'] }}</div>
                  	</div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
             
              </div>
            </div>
            @endcan
            @can('dash_board_venue_info')
            <div class="col-lg-7">
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="card-title fs-4 fw-semibold">{!! $chart4->options['chart_title'] !!}</div>
                  <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas class="chart" id="main-bar-chart" height="300">{!! $chart4->renderHtml() !!}</canvas>
                  </div>
                </div>
              </div>
            </div>
           @endcan
            
           @can('dash_board_recent_appointment_booking')
            <div class="col-lg-5">
                  <div class="card mb-4">
                    <div class="card-body p-4">
                      <div class="row">
                        <div class="col">
                          <div class="card-title fs-4 fw-semibold">{{ $settings6['chart_title'] }}</div>
                        </div>
                      </div>
                      <div class="table-responsive" style="height:300px;">
                        <table class="table mb-0">
                                <thead class="fw-semibold text-disabled">
                                    <tr class="align-middle">
                                        @foreach($settings6['fields'] as $key => $value)
                                            <th class="text-center">
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings6['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings6['data'] as $entry)
                                        <tr class="align-middle">
                                            @foreach($settings6['fields'] as $key => $value)
                                                <td class="text-center">
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
                                            <td colspan="{{ count($settings6['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                      </div>
                      <div class="{{ $chart8->options['column_class'] }}">
                            <h3>{!! $chart8->options['chart_title'] !!}</h3>
                        <canvas class="chart" height="150">{!! $chart8->renderHtml() !!}</canvas>
                            
                        </div>
                    </div>
                
              </div>
            </div>
            @endcan
            
          <div class="row">
            @can('dash_board_recent_member')
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-title fs-4 fw-semibold">{{ $settings5['chart_title'] }}</div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead class="fw-semibold text-disabled">
                        <tr class="align-middle">
                           @foreach($settings5['fields'] as $key => $value)
                          	<th class="text-center">{{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}</th>
                           @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($settings5['data'] as $entry)
                                        <tr class="align-middle">
                                            @foreach($settings5['fields'] as $key => $value)
                                                <td class="text-center">
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
                                            <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            @endcan
            @can('dash_board_recent_issue_raised')
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-title fs-4 fw-semibold">{{ $settings21['chart_title'] }}</div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead class="fw-semibold text-disabled">
                        <tr class="align-middle">
                          @foreach($settings21['fields'] as $key => $value)
                          <th class="text-center">{{ trans(sprintf('cruds.%s.fields.%s', $settings21['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}</th>
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
                                            <td colspan="{{ count($settings21['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            @endcan
            
          <div class="row">
            @can('dash_board_recent_member')
            <div class="col-lg-9">
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-title fs-4 fw-semibold">{{ $settings5['chart_title'] }}</div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead class="fw-semibold text-disabled">
                        <tr class="align-middle">
                           @foreach($settings5['fields'] as $key => $value)
                          	<th class="text-center">{{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}</th>
                           @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($settings5['data'] as $entry)
                                        <tr class="align-middle">
                                            @foreach($settings5['fields'] as $key => $value)
                                                <td class="text-center">
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
                                            <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            @endcan
            
            <div class="col-lg-3">
              <div class="card mb-4 text-white bg-primary-gradient">
                <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                        <svg class="icon">
                          <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>Users</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:80px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
              </div>
              <div class="card mb-4 text-white bg-warning-gradient">
                <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                        </svg>)</span></div>
                    <div>Conversion Rate</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="chart-wrapper mt-3" style="height:80px;">
                  <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
              </div>
              <div class="card mb-4 text-white bg-danger-gradient">
                <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                        <svg class="icon">
                          <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>Sessions</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:80px;">
                  <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="card-title fs-4 fw-semibold">Traffic</div>
                  <div class="card-subtitle text-disabled border-bottom mb-3 pb-4">Last Week</div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-info px-3 mb-3"><small class="text-disabled">New Clients</small>
                            <div class="fs-5 fw-semibold">9.123</div>
                          </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-danger px-3 mb-3"><small class="text-disabled">Recuring Clients</small>
                            <div class="fs-5 fw-semibold">22.643</div>
                          </div>
                        </div>
                        <!-- /.col-->
                      </div>
                      <!-- /.row-->
                      <div class="progress-group mb-4 pt-4 border-top">
                        <div class="progress-group-prepend"><span class="text-disabled small">Monday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Tuesday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Wednesday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Thursday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Friday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Saturday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-disabled small">Sunday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-warning px-3 mb-3"><small class="text-disabled">Pageviews</small>
                            <div class="fs-5 fw-semibold">78.623</div>
                          </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-success px-3 mb-3"><small class="text-disabled">Organic</small>
                            <div class="fs-5 fw-semibold">49.123</div>
                          </div>
                        </div>
                        <!-- /.col-->
                      </div>
                      <!-- /.row-->
                      <div class="progress-group mb-4 pt-4 border-top">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                          </svg>
                          <div>Male</div>
                          <div class="ms-auto fw-semibold">43%</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-5">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-female"></use>
                          </svg>
                          <div>Female</div>
                          <div class="ms-auto fw-semibold">37%</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-google"></use>
                          </svg>
                          <div>Organic Search</div>
                          <div class="ms-auto fw-semibold me-2">191.235</div>
                          <div class="text-disabled small">(56%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                          </svg>
                          <div>Facebook</div>
                          <div class="ms-auto fw-semibold me-2">51.223</div>
                          <div class="text-disabled small">(15%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter"></use>
                          </svg>
                          <div>Twitter</div>
                          <div class="ms-auto fw-semibold me-2">37.564</div>
                          <div class="text-disabled small">(11%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 11%" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
                          </svg>
                          <div>LinkedIn</div>
                          <div class="ms-auto fw-semibold me-2">27.319</div>
                          <div class="text-disabled small">(8%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-->
                  </div>
                  <!-- /.row-->
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->
        </div>
      </div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart4->renderJs() !!}{!! $chart8->renderJs() !!}{!! $chart9->renderJs() !!}{!! $chart10->renderJs() !!}{!! $chart18->renderJs() !!}{!! $chart19->renderJs() !!}{!! $chart22->renderJs() !!}{!! $chart24->renderJs() !!}{!! $chart26->renderJs() !!}{!! $chart27->renderJs() !!}{!! $chart28->renderJs() !!}{!! $chart31->renderJs() !!}{!! $chart32->renderJs() !!}{!! $chart33->renderJs() !!}
@endsection
