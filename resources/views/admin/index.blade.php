@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="layout-page">
        <!-- Navbar -->

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

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
                                <h4 class="mb-0">$28,450</h4>
                            </div>
                            <div class="card-body px-0">
                                <div id="averageDailySales"></div>
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
                                    <p class="card-text fw-medium text-success">+18.2%</p>
                                </div>
                                <h4 class="card-title mb-1">$42.5k</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="d-flex gap-2 align-items-center mb-2">
                                            <span class="badge bg-label-info p-1 rounded"><i
                                                    class="ti ti-shopping-cart ti-sm"></i></span>
                                            <p class="mb-0">Order</p>
                                        </div>
                                        <h5 class="mb-0 pt-1">62.2%</h5>
                                        <small class="text-muted">6,440</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="divider divider-vertical">
                                            <div class="divider-text">
                                                <span class="badge-divider-bg bg-label-secondary">VS</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                            <p class="mb-0">Visits</p>
                                            <span class="badge bg-label-primary p-1 rounded"><i
                                                    class="ti ti-link ti-sm"></i></span>
                                        </div>
                                        <h5 class="mb-0 pt-1">25.5%</h5>
                                        <small class="text-muted">12,749</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-6">
                                    <div class="progress w-100" style="height: 10px">
                                        <div class="progress-bar bg-info" style="width: 70%" role="progressbar"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <h5 class="mb-1">Earning Reports</h5>
                                    <p class="card-subtitle">Weekly Earnings Overview</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                        type="button" id="earningReportsId" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center g-md-8">
                                    <div class="col-12 col-md-5 d-flex flex-column">
                                        <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                                            <h2 class="mb-0">$468</h2>
                                            <div class="badge rounded bg-label-success">+4.2%</div>
                                        </div>
                                        <small class="text-body">You informed of this week compared to last week</small>
                                    </div>
                                    <div class="col-12 col-md-7 ps-xl-8">
                                        <div id="weeklyEarningReports"></div>
                                    </div>
                                </div>
                                <div class="border rounded p-5 mt-5">
                                    <div class="row gap-4 gap-sm-0">
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-primary p-1">
                                                    <i class="ti ti-currency-dollar ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Earnings</h6>
                                            </div>
                                            <h4 class="my-2">$545.69</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar" role="progressbar" style="width: 65%"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-info p-1"><i
                                                        class="ti ti-chart-pie-2 ti-sm"></i></div>
                                                <h6 class="mb-0 fw-normal">Profit</h6>
                                            </div>
                                            <h4 class="my-2">$256.34</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="badge rounded bg-label-danger p-1">
                                                    <i class="ti ti-brand-paypal ti-sm"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Expense</h6>
                                            </div>
                                            <h4 class="my-2">$74.19</h4>
                                            <div class="progress w-75" style="height: 4px">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Earning Reports -->

                    <!-- Support Tracker -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between">
                                <div class="card-title mb-0">
                                    <h5 class="mb-1">Support Tracker</h5>
                                    <p class="card-subtitle">Last 7 Days</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                        type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                                        <h2 class="mb-0">164</h2>
                                        <p class="mb-0">Total Tickets</p>
                                    </div>
                                    <ul class="p-0 m-0">
                                        <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                            <div class="badge rounded bg-label-primary p-1_5"><i
                                                    class="ti ti-ticket ti-md"></i></div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">New Tickets</h6>
                                                <small class="text-muted">142</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                            <div class="badge rounded bg-label-info p-1_5">
                                                <i class="ti ti-circle-check ti-md"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                                                <small class="text-muted">28</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-4 align-items-center pb-1">
                                            <div class="badge rounded bg-label-warning p-1_5"><i
                                                    class="ti ti-clock ti-md"></i></div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">Response Time</h6>
                                                <small class="text-muted">1 Day</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                    <div id="supportTracker"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="order-stats"></div>
                    <div id="order-chart"></div>
                    <div id="daily-order"></div>
                    <div id="order-chart"></div>
                    <div class="tooltip"></div>

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Orders</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <tr class="bg-gray-100">

                                            <th class="">#</th>
                                            <th class="">Order</th>
                                            <th class="">Customer</th>
                                            <th class="">Total Amount</th>
                                            <th class="">Payment Status</th>
                                            <th class="">Status</th>
                                            <th class="">Date</th>
                                            <th class="">Actions</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        {{-- {{dd($orders)}} --}}
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $order->order_number }}</td>
                                                <td class="">{{ $order->user->name }}</td>
                                                <td class="">₹{{ number_format($order->total_amount, 2) }}</td>
                                                <td class="">{{ ucfirst($order->payment_status) }}</td>
                                                <td class="">{{ ucfirst($order->status) }}</td>
                                                <td class="">{{ $order->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                  class="ti ti-pencil me-1"></i> Edit</a> --}}
                                                            <a class="dropdown-item"
                                                                href="{{ route('orders.order-Details', $order->id) }}"><i
                                                                    class="ti ti-pencil me-1"></i> View</a>
                                                            {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                  class="ti ti-trash me-1"></i> Delete</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>


                        <!--/ Hoverable Table rows -->


                    </div>
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                    <div
                        class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                        <div class="text-body">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by <a href="https://trapigo.in/" target="_blank"
                                class="footer-link">Trapigo</a>
                        </div>
                        <div class="d-none d-lg-inline-block">
                            <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                target="_blank">License</a>
                            <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                class="footer-link me-4">More Themes</a>

                            <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank"
                                class="footer-link me-4">Documentation</a>

                            <a href="https://pixinvent.ticksy.com/" target="_blank"
                                class="footer-link d-none d-sm-inline-block">Support</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>

    <script src="https://d3js.org/d3.v7.min.js"></script>



    <script>
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
    </script>

    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
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
    </style>

    <script>
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
                    left: 60
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
    </script>


@endsection
