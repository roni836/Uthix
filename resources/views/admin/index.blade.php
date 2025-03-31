@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

    

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row g-6">
                    <!-- Website Analytics -->
                    <div class="col-lg-6">
                        <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                            id="swiper-with-pagination-cards">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-white mb-0">Website Analytics</h5>
                                            <small>Total 28.5% Conversion Rate</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                                <h6 class="text-white mt-0 mt-md-3 mb-4">Traffic</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="d-flex mb-4 align-items-center">
                                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">28%
                                                                </p>
                                                                <p class="mb-0">Sessions</p>
                                                            </li>
                                                            <li class="d-flex align-items-center">
                                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                    1.2k</p>
                                                                <p class="mb-0">Leads</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="d-flex mb-4 align-items-center">
                                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                    3.1k</p>
                                                                <p class="mb-0">Page Views</p>
                                                            </li>
                                                            <li class="d-flex align-items-center">
                                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%
                                                                </p>
                                                                <p class="mb-0">Conversions</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                                <img src="../../assets/img/illustrations/card-website-analytics-1.png"
                                                    alt="Website Analytics" height="150"
                                                    class="card-website-analytics-img" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-white mb-0">Website Analytics</h5>
                                            <small>Total 28.5% Conversion Rate</small>
                                        </div>
                                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                            <h6 class="text-white mt-0 mt-md-3 mb-4">Spending</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12h</p>
                                                            <p class="mb-0">Spend</p>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">127</p>
                                                            <p class="mb-0">Order</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">18</p>
                                                            <p class="mb-0">Order Size</p>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">2.3k
                                                            </p>
                                                            <p class="mb-0">Items</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                            <img src="../../assets/img/illustrations/card-website-analytics-2.png"
                                                alt="Website Analytics" height="150" class="card-website-analytics-img" />
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-white mb-0">Website Analytics</h5>
                                            <small>Total 28.5% Conversion Rate</small>
                                        </div>
                                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                            <h6 class="text-white mt-0 mt-md-3 mb-4">Revenue Sources</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">268</p>
                                                            <p class="mb-0">Direct</p>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">62</p>
                                                            <p class="mb-0">Referral</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">890</p>
                                                            <p class="mb-0">Organic</p>
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k
                                                            </p>
                                                            <p class="mb-0">Campaign</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                            <img src="../../assets/img/illustrations/card-website-analytics-3.png"
                                                alt="Website Analytics" height="150" class="card-website-analytics-img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <!--/ Website Analytics -->

                    <!-- Average Daily Sales -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h5 class="mb-3 card-title">Average Daily Sales</h5>
                                <p class="mb-0 text-body">Total Sales This Month</p>
                                <h4 class="mb-0">₹{{ number_format($totalSalesThisMonth, 2) }}</h4>
                            </div>
                            <div class="card-body px-0">
                                <div id="averageDailySales">
                                    <h4 class="text-primary text-center mb-0">${{ number_format($averageDailySales, 2) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Average Daily Sales -->

                    <!-- Sales Overview -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 text-body">Sales Overview</p>
                                    <p class="card-text fw-medium text-success">+{{ $salesGrowth }}%</p>
                                </div>
                                <h4 class="card-title mb-1">₹{{ number_format($totalSales, 1) }}k</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Total Orders -->
                                    <div class="col-6">
                                        <div class="d-flex gap-2 align-items-center mb-2">
                                            <span class="badge bg-label-info p-1 rounded">
                                                <i class="ti ti-shopping-cart ti-sm"></i>
                                            </span>
                                            <p class="mb-0">Orders</p>
                                        </div>
                                        <h5 class="mb-0 pt-1">{{ $orderPercentage }}%</h5>
                                        <small class="text-muted">{{ number_format($totalOrders) }}</small>
                                    </div>

                                    <!-- Divider -->
                                    <div class="col-2">
                                        <div class="divider divider-vertical">
                                            <div class="divider-text">
                                                <span class="badge-divider-bg bg-label-secondary">VS</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Users -->
                                    <div class="col-4 text-end">
                                        <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                            <p class="mb-0">Users</p>
                                            <span class="badge bg-label-primary p-1 rounded">
                                                <i class="ti ti-users ti-sm"></i>
                                            </span>
                                        </div>
                                        <h5 class="mb-0 pt-1">{{ $userPercentage }}%</h5>
                                        <small class="text-muted">{{ number_format($totalUsers) }}</small>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="d-flex align-items-center mt-6">
                                    <div class="progress w-100" style="height: 10px">
                                        <div class="progress-bar bg-info" style="width: {{ $orderPercentage }}%"
                                            role="progressbar" aria-valuenow="{{ $orderPercentage }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $userPercentage }}%" aria-valuenow="{{ $userPercentage }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--/ Sales Overview -->

                    <!-- Earning Reports -->
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header pb-0 d-flex justify-content-between">
                                <div class="card-title mb-0">
                                    <h5 class="mb-1">User Reports</h5>
                                    <p class="card-subtitle">Total Users Overview</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                        type="button" id="userReportsId" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userReportsId">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center g-md-8">
                                    <div class="col-12 col-md-5 d-flex flex-column">
                                        <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                                            <div class="badge rounded bg-label-success">+{{ $userGrowth }}%</div>
                                        </div>
                                        <small class="text-body">User count compared to last month</small>
                                    </div>
                                    <div class="col-12 col-md-7 ps-xl-8">
                                        <div id="userReportsChart"></div>
                                    </div>
                                </div>
                                <div class="border rounded p-5 mt-5">
                                    <div class="row gap-4 gap-sm-0">
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-primary p-1">
                                                    <i class="ti ti-user ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Total Instructors</h6>
                                            </div>
                                            <h4 class="my-2">{{ $totalInstructors }}</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $instructorPercentage }}%"
                                                    aria-valuenow="{{ $instructorPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-info p-1">
                                                    <i class="ti ti-users ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Total Students</h6>
                                            </div>
                                            <h4 class="my-2">{{ $totalStudents }}</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $studentPercentage }}%"
                                                    aria-valuenow="{{ $studentPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-warning p-1">
                                                    <i class="ti ti-shopping-cart ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Total Sellers</h6>
                                            </div>
                                            <h4 class="my-2">{{ $totalSellers }}</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $sellerPercentage }}%"
                                                    aria-valuenow="{{ $sellerPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="order-chart" class="p-3 "></div>

                    </div>


                    <!-- Support Tracker -->
                   
                    <div class="row mt-4"> <!-- Added margin-top -->
                        <!-- Manage Orders -->
                        <div class="col-lg-6 col-md-12">
                            <div class="card h-100" style="background: #f8f9fa;"> <!-- Gray background -->
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Manage Orders</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order</th>
                                                    <th>Customer</th>
                                                    <th>Total Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $key => $order)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $order->order_number }}</td>
                                                        <td>{{ $order->user->name }}</td>
                                                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                                        <td>
                                                            @if ($order->status == 'cancelled')
                                                                <span class="badge bg-danger">
                                                                    <i class="ti ti-ban"></i> Cancelled
                                                                </span>
                                                            @elseif ($order->status == 'completed')
                                                                <span class="badge bg-success">Completed</span>
                                                            @elseif ($order->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Support Tracker -->
                        <div class="col-lg-6 col-md-12">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">Support Tracker</h5>
                                        <p class="card-subtitle">Last 7 Days</p>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-text-secondary rounded-pill border-0 p-2" type="button" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical ti-md"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">View More</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-4 col-md-12 text-center">
                                        <h2 class="mb-0">164</h2>
                                        <p>Total Tickets</p>
                                        <ul class="list-unstyled">
                                            <li class="d-flex gap-3 align-items-center mb-2">
                                                <span class="badge bg-primary p-2"><i class="ti ti-ticket"></i></span>
                                                <div>
                                                    <h6 class="mb-0">New Tickets</h6>
                                                    <small>142</small>
                                                </div>
                                            </li>
                                            <li class="d-flex gap-3 align-items-center mb-2">
                                                <span class="badge bg-info p-2"><i class="ti ti-circle-check"></i></span>
                                                <div>
                                                    <h6 class="mb-0">Open Tickets</h6>
                                                    <small>28</small>
                                                </div>
                                            </li>
                                            <li class="d-flex gap-3 align-items-center">
                                                <span class="badge bg-warning p-2"><i class="ti ti-clock"></i></span>
                                                <div>
                                                    <h6 class="mb-0">Response Time</h6>
                                                    <small>1 Day</small>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div id="supportTracker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                      

                    {{-- upcoming classes --}}
                    <div class="row mt-10">
                        @foreach ($upcomingClasses as $class)
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100 shadow-lg">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $class->classroom->class_name }} - {{ $class->classroom->section }}</h5>
                                            <p class="mb-0 text-muted">{{ $class->subject->name }}</p>
                                        </div>
                                        @if ($class->classroom->status == 'active')
                                            <span class="blinking-circle"></span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2"><strong>Instructor:</strong> {{ $class->instructor->name }}</p>
                                        <p class="mb-2"><strong>Capacity:</strong> {{ $class->classroom->capacity }} students</p>
                                        <p class="mb-2"><strong>Schedule:</strong>
                                            {{ \Carbon\Carbon::parse($class->classroom->schedule)->format('d M, Y h:i A') }}</p>
                                        <p class="mb-3 text-muted">{{ Str::limit($class->classroom->description, 80) }}</p>
                                        @if ($class->classroom->link)
                                            <a href="{{ $class->classroom->link }}" target="_blank" class="btn btn-primary w-100">Join Class</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    

                    @if ($upcomingClasses->isEmpty())
                        <div class="text-center mt-4">
                            <h5 class="text-muted">No Upcoming Classes</h5>
                        </div>
                    @endif

                </div>
            </div>
          

    <script src="https://d3js.org/d3.v7.min.js"></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = [{
                    label: "Pending",
                    value: {{ $orderStats['pending'] }}
                },
                {
                    label: "Completed",
                    value: {{ $orderStats['completed'] }}
                },
                {
                    label: "Cancelled",
                    value: {{ $orderStats['cancelled'] }}
                }
            ];

            const width = 400,
                height = 400,
                radius = Math.min(width, height) / 2;

            const color = d3.scaleOrdinal(["#ffcc00", "#28a745", "#dc3545"]); // Colors for categories

            const svg = d3.select("#order-stats")
                .append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", `translate(${width / 2}, ${height / 2})`);

            const pie = d3.pie().value(d => d.value);
            const arc = d3.arc().innerRadius(0).outerRadius(radius);

            svg.selectAll("path")
                .data(pie(data))
                .enter()
                .append("path")
                .attr("d", arc)
                .attr("fill", (d, i) => color(i))
                .attr("stroke", "#fff")
                .attr("stroke-width", "2px");

            svg.selectAll("text")
                .data(pie(data))
                .enter()
                .append("text")
                .attr("transform", d => `translate(${arc.centroid(d)})`)
                .attr("text-anchor", "middle")
                .attr("font-size", "14px")
                .attr("fill", "#fff")
                .text(d => d.data.label);
        });
    </script> --}}

    {{-- <script src="https://d3js.org/d3.v7.min.js"></script> --}}
    {{-- <style>
        #order-chart {
            background: #1e1e2f;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .bar:hover {
            fill: #ffcc00 !important;
            cursor: pointer;
        }
    </style> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = [
                @foreach ($dailyOrders as $order)
                    {
                        day: "{{ $order->day }}",
                        count: {{ $order->count }}
                    },
                @endforeach
            ];

            const width = 700,
                height = 400,
                margin = {
                    top: 30,
                    right: 30,
                    bottom: 50,
                    left: 80
                };

            const svg = d3.select("#order-chart")
                .append("svg")
                .attr("width", width)
                .attr("height", height)
                .style("background", "#2c2c3e")
                .style("border-radius", "10px");

            const x = d3.scaleBand()
                .domain(data.map(d => d.day))
                .range([margin.left, width - margin.right])
                .padding(0.3);

            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.count)])
                .nice()
                .range([height - margin.bottom, margin.top]);

            const tooltip = d3.select(".tooltip");

            svg.append("g")
                .attr("transform", `translate(0,${height - margin.bottom})`)
                .call(d3.axisBottom(x))
                .selectAll("text")
                .attr("fill", "#fff")
                .attr("font-size", "14px")
                .attr("text-anchor", "middle");

            svg.append("g")
                .attr("transform", `translate(${margin.left},0)`)
                .call(d3.axisLeft(y))
                .selectAll("text")
                .attr("fill", "#fff");

            svg.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", d => x(d.day))
                .attr("y", height - margin.bottom)
                .attr("height", 0)
                .attr("width", x.bandwidth())
                .attr("fill", "#4CAF50")
                .transition()
                .duration(800)
                .attr("y", d => y(d.count))
                .attr("height", d => y(0) - y(d.count));

            svg.selectAll(".bar")
                .on("mouseover", function(event, d) {
                    d3.select(this).attr("fill", "#ffcc00");
                    tooltip.style("visibility", "visible")
                        .html(`<strong>${d.day}</strong>: ${d.count} Orders`)
                        .style("left", event.pageX + "px")
                        .style("top", (event.pageY - 30) + "px")
                        .style("opacity", 1);
                })
                .on("mousemove", function(event) {
                    tooltip.style("left", event.pageX + "px")
                        .style("top", (event.pageY - 30) + "px");
                })
                .on("mouseout", function() {
                    d3.select(this).attr("fill", "#4CAF50");
                    tooltip.style("visibility", "hidden")
                        .style("opacity", 0);
                });

            svg.append("text")
                .attr("x", width / 2)
                .attr("y", height - 10)
                .attr("text-anchor", "middle")
                .attr("fill", "#fff")
                .attr("font-size", "16px")
                .text("Orders Per Day of the Week");

            svg.append("text")
                .attr("x", -(height / 2))
                .attr("y", 20)
                .attr("text-anchor", "middle")
                .attr("fill", "#fff")
                .attr("transform", "rotate(-90)")
                .attr("font-size", "16px")
                .text("Number of Orders");
        });
    </script> --}}
    {{-- <script src="https://d3js.org/d3.v4.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/api/weekly-orders')
            .then(response => response.json())
            .then(data => {
                // Parse date format for D3.js
                var parseDate = d3.timeParse("%Y-%m-%d");
                data.forEach(d => d.date = parseDate(d.date));

                // Set dimensions
                var margin = { top: 10, right: 30, bottom: 30, left: 60 },
                    width = 600 - margin.left - margin.right,
                    height = 400 - margin.top - margin.bottom;

                // Append SVG
                var svg = d3.select("#my_dataviz")
                    .append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                // X-axis (Date Scale)
                var x = d3.scaleTime()
                    .domain(d3.extent(data, d => d.date))
                    .range([0, width]);

                svg.append("g")
                    .attr("transform", "translate(0," + height + ")")
                    .call(d3.axisBottom(x).ticks(7));

                // Y-axis (Orders Count)
                var y = d3.scaleLinear()
                    .domain([0, d3.max(data, d => d.count)])
                    .range([height, 0]);

                svg.append("g")
                    .call(d3.axisLeft(y));

                // Gradient for Line Chart
                var gradient = svg.append("defs")
                    .append("linearGradient")
                    .attr("id", "line-gradient")
                    .attr("gradientUnits", "userSpaceOnUse")
                    .attr("x1", 0)
                    .attr("y1", y(0))
                    .attr("x2", 0)
                    .attr("y2", y(d3.max(data, d => d.count)))
                    .selectAll("stop")
                    .data([{ offset: "0%", color: "blue" }, { offset: "100%", color: "red" }])
                    .enter().append("stop")
                    .attr("offset", d => d.offset)
                    .attr("stop-color", d => d.color);

                // Line Generator
                var line = d3.line()
                    .x(d => x(d.date))
                    .y(d => y(d.count));

                // Add Line
                svg.append("path")
                    .datum(data)
                    .attr("fill", "none")
                    .attr("stroke", "url(#line-gradient)")
                    .attr("stroke-width", 2)
                    .attr("d", line);
            })
            .catch(error => console.error("Error loading data:", error));
    });
</script> --}}




    <style>
        .blinking-circle {
            display: inline-block;
            width: 15px;
            height: 15px;
            background-color: #28a745;
            border-radius: 50%;
            box-shadow: 0 0 5px #28a745;
            animation: blinkEffect 1s infinite alternate;
        }

        @keyframes blinkEffect {
            0% {
                opacity: 1;
                box-shadow: 0 0 5px #28a745;
            }

            100% {
                opacity: 0.3;
                box-shadow: 0 0 10px #28a745;
            }
        }
    </style>

    {{-- graph order --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Define all days of the week
            const allDays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

            // Fill missing days with count = 0
            const ordersMap = new Map([
                @foreach ($dailyOrders as $order)
                    ["{{ \Carbon\Carbon::parse($order->day)->format('D') }}", {{ $order->count }}],
                @endforeach
            ]);


            const data = allDays.map(day => ({
                day: day,
                count: ordersMap.get(day) || 0
            }));

            const width = 580,
                height = 400,
                margin = {
                    top: 30,
                    right: 30,
                    bottom: 50,
                    left: 80
                };

            // Select the chart container
            const chartContainer = d3.select("#order-chart");

            // Create SVG for chart
            const svg = chartContainer.append("svg")
                .attr("width", width)
                .attr("height", height)
                .style("background", "#f0f0f0")
                .style("border-radius", "10px");

            // Define scales
            const x = d3.scaleBand()
                .domain(data.map(d => d.day))
                .range([margin.left, width - margin.right])
                .padding(0.3);

            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.count) || 1]) // Prevents errors if all counts are 0
                .nice()
                .range([height - margin.bottom, margin.top]);

            // X-Axis
            svg.append("g")
                .attr("transform", `translate(0,${height - margin.bottom})`)
                .call(d3.axisBottom(x))
                .selectAll("text")
                .attr("fill", "#ff0000") // Default red text for all days
                .attr("font-size", "14px")
                .attr("text-anchor", "middle")
                .each(function(d) {
                    if (ordersMap.has(d)) {
                        d3.select(this).attr("fill", "#2e7d32"); // Green if order exists
                    }
                });

            // Y-Axis
            svg.append("g")
                .attr("transform", `translate(${margin.left},0)`)
                .call(d3.axisLeft(y))
                .selectAll("text")
                .attr("fill", "#333");

            // Bars
            svg.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", d => x(d.day))
                .attr("y", d => y(d.count))
                .attr("height", d => y(0) - y(d.count))
                .attr("width", x.bandwidth())
                .attr("fill", d => (d.count > 0 ? "#2e7d32" : "#ff0000")) // Green for orders, Red for no orders

            // Chart Title
            svg.append("text")
                .attr("x", width / 2)
                .attr("y", height - 10)
                .attr("text-anchor", "middle")
                .attr("fill", "#000")
                .attr("font-size", "16px")
                .text("Orders Per Day of the Week");

            // Y-Axis Label
            svg.append("text")
                .attr("x", -(height / 2))
                .attr("y", 20)
                .attr("text-anchor", "middle")
                .attr("fill", "#000")
                .attr("transform", "rotate(-90)")
                .attr("font-size", "16px")
                .text("Number of Orders");
        });
    </script>


@endsection
