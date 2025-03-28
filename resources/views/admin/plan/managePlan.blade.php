@extends('admin.layout')
@section('title', 'Manage Plan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white shadow-lg border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 fw-bold">Subscription Plans</h2>
                            <p class="mb-0 opacity-8">Manage your pricing plans and features</p>
                        </div>
                        <a href="{{route('insert.plan')}}" class="btn btn-light">
                            <i class="ti ti-plus me-1"></i>Add New Plan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plans Cards View -->
    <div class="row mb-4">
        @foreach ($plans as $plan)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm position-relative plan-card">
                <div class="position-absolute top-0 end-0 p-3">
                    <form action="{{ route('toggle.plan.status', $plan->id) }}" method="POST" class="mb-0">
                        @csrf
                        @method('PUT')
                        <label class="switch">
                            <input type="checkbox" name="status" onchange="this.form.submit()" {{ $plan->status ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </form>
                </div>
                
                <div class="card-header bg-transparent py-4 text-center border-bottom">
                    <h4 class="card-title mb-1 fw-bold">{{ $plan->name }}</h4>
                    <p class="text-muted mb-0">{{ $plan->description ?? 'No description available' }}</p>
                </div>
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="pricing-value fw-bold mb-0">₹{{ number_format($plan->price, 2) }}</h2>
                        <span class="text-muted">per {{ strtolower($plan->duration) }}</span>
                    </div>
                    
                    <div class="features-list">
                        <h6 class="fw-semibold">Features</h6>
                        <hr>
                        @php
                            $features = is_array($plan->features)
                                ? $plan->features
                                : json_decode($plan->features, true);
                        @endphp

                        @if (!empty($features) && is_array($features))
                            <ul class="list-unstyled">
                                @foreach ($features as $feature)
                                <li class="mb-2">
                                    <i class="ti ti-check-circle text-success me-2"></i>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center text-muted fst-italic">No features specified</p>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer border-top bg-transparent d-flex justify-content-between py-3">
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="ti ti-pencil me-1"></i>Edit
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm" 
                        onclick="if(confirm('Are you sure you want to delete this plan?')) { /* Delete action */ }">
                        <i class="ti ti-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Table View Toggle Button -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <button type="button" class="btn btn-outline-secondary" id="toggleViewBtn">
                <i class="ti ti-table me-1"></i>Switch to Table View
            </button>
        </div>
    </div>

    <!-- Table View (Initially Hidden) -->
    <div class="row" id="tableView" style="display: none;">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="card-title mb-0">All Plans</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover border-top">
                        <thead>
                            <tr>
                                <th class="bg-light">Name</th>
                                <th class="bg-light">Description</th>
                                <th class="bg-light">Price</th>
                                <th class="bg-light">Duration</th>
                                <th class="bg-light">Features</th>
                                <th class="bg-light">Status</th>
                                <th class="bg-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $plan->name }}</span>
                                    </td>
                                    <td>
                                        <span>{{ Str::limit($plan->description, 50) ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-primary">₹{{ number_format($plan->price, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-primary">{{ ucfirst($plan->duration) }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $features = is_array($plan->features)
                                                ? $plan->features
                                                : json_decode($plan->features, true);
                                        @endphp

                                        @if (!empty($features) && is_array($features))
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="popover" 
                                                data-bs-placement="top" 
                                                data-bs-content="{{ implode(', ', $features) }}">
                                                View Features
                                            </button>
                                        @else
                                            <span class="text-danger">No Features</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('toggle.plan.status', $plan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label class="switch">
                                                <input type="checkbox" name="status" onchange="this.form.submit()" {{ $plan->status ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-icon btn-outline-secondary dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">
                                                    <i class="ti ti-eye me-1"></i> View Details
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="ti ti-pencil me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" onclick="return confirm('Are you sure you want to delete this plan?')">
                                                    <i class="ti ti-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Switch Styling */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 20px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #4caf50;
    }

    input:checked+.slider:before {
        transform: translateX(20px);
    }

    /* Card Styling */
    .plan-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 0.5rem;
        overflow: hidden;
        border: none;
    }

    .plan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .pricing-value {
        font-size: 2rem;
        color: #696cff;
    }

    .features-list ul li {
        position: relative;
    }

    .bg-primary {
        background: linear-gradient(135deg, #696cff 0%, #8592d8 100%) !important;
    }

    .badge.bg-label-primary {
        background-color: #e7e7ff !important;
        color: #696cff !important;
    }

    /* Popover Customization */
    .popover {
        max-width: 300px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle between card and table view
        const toggleBtn = document.getElementById('toggleViewBtn');
        const tableView = document.getElementById('tableView');
        const cardsView = document.querySelector('.row.mb-4');
        
        toggleBtn.addEventListener('click', function() {
            if (tableView.style.display === 'none') {
                tableView.style.display = 'block';
                cardsView.style.display = 'none';
                toggleBtn.innerHTML = '<i class="ti ti-layout-grid me-1"></i>Switch to Card View';
            } else {
                tableView.style.display = 'none';
                cardsView.style.display = 'flex';
                toggleBtn.innerHTML = '<i class="ti ti-table me-1"></i>Switch to Table View';
            }
        });

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
</script>
@endsection