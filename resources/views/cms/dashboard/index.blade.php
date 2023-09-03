@extends('cms.layouts.app')
@section('style')
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
@endsection
@section('content')
    {{-- <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Businesses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $businessesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-birthday-cake fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Packages</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $packagesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pending Requests
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $requestsCount }}</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            @php($pecentage = ($requestsCount * 100) / $allCount)
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $pecentage }}%" aria-valuenow="{{ $requestsCount }}"
                                                aria-valuemin="0" aria-valuemax="{{ $allCount }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Pie Chart -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Users Roles</h6>

                    </div>
                    <!-- Card Body -->
                    <input type="hidden" id="usersRoleCount" value="{{ $usersRoleCount }}">
                    <input type="hidden" id="adminsRoleCount" value="{{ $adminsRoleCount }}">
                    <input type="hidden" id="ownersRoleCount" value="{{ $ownersRoleCount }}">
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Admin
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i>App User
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Business Owner
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Requests Chart -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Requests Timeline</h6>

                    </div>
                    <div id="monthes" style="display: none">{{ $monthes }}</div>
                    <div id="requestByDate" style="display: none">{{ $requestByDate }}</div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Joining Chart -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Joining Businesses Timeline</h6>

                    </div>
                    <div id="joiningByDate" style="display: none">{{ $joiningByDate }}</div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChartJoin"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Joining Chart -->
            <div class="col-md-6">
                
                <!-- Packages Chart -->
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Packages Timeline</h6>

                  </div>
                  <div id="packagesByDate" style="display: none">{{ $packagesByDate }}</div>
                  <!-- Card Body -->
                  <div class="card-body">
                      <div class="chart-area">
                          <canvas id="myAreaChartPackage"></canvas>
                      </div>
                  </div>
              </div>

            </div>

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">


                <!-- Events Chart -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Events Timeline</h6>

                    </div>
                    <div id="eventsByDate" style="display: none">{{ $eventsByDate }}</div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChartEvent"></canvas>
                        </div>
                    </div>
                </div>



            </div>
            <!-- User Column -->
            <div class="col-lg-6 mb-4">


                <!-- Events Chart -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Joining Users Timeline</h6>

                    </div>
                    <div id="usersByDate" style="display: none">{{ $usersByDate }}</div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChartUser"></canvas>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div> --}}
@endsection
