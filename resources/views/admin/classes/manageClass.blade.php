@extends('admin.layout')
@section('title', 'Manage Classes')
@section('content')

<div class="container-xxl mt-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-0">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Manage Classes
                </h2>
                <div>
                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-2"></i>Go back
                    </a>
                </div>
            </div>
            <hr class="my-3">
        </div>
    </div>
    
    <!-- Filter Section (Optional) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    <form method="GET" class="row g-3">
                        <!-- Filter by Subject -->
                        <div class="col-md-3">
                            <select class="form-select" name="subject" onchange="this.form.submit()">
                                <option value="">Filter by Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Filter by Status -->
                        <div class="col-md-3">
                            <select class="form-select" name="status" onchange="this.form.submit()">
                                <option value="">Filter by Status</option>
                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    
                        <!-- Search by Class Name -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search classes..."
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    
                        <!-- Reset Button -->
                        <div class="col-md-2">
                            <a href="{{ route('manage.class') }}" class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4 text-dark">#</th>
                                    <th class="py-3 text-dark">Class Name</th>
                                    <th class="py-3 text-dark">Instructor</th>
                                    <th class="py-3 text-dark">Subject</th>
                                    <th class="py-3 text-dark">Capacity</th>
                                    <th class="py-3 text-dark">Schedule</th>
                                    <th class="py-3 text-dark">Status</th>
                                    <th class="py-3 text-dark text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $key=>$data)
                                <tr class="border-bottom">
                                    <td class="py-3 px-4">
                                        <span class="fw-bold">{{ ($classes->currentPage() - 1) * $classes->perPage() + $key + 1 }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="class-icon me-3 bg-light rounded-circle p-2">
                                                <i class="fas fa-book text-primary"></i>
                                            </div>
                                            <span class="fw-bold">{{ $data->class_name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2">
                                                <div class="avatar-initial rounded-circle bg-primary">
                                                    {{ substr($data->instructor->name, 0, 1) }}
                                                </div>
                                            </div>
                                            {{ $data->instructor->name }}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-light text-dark px-3 py-2">{{ $data->subject->name }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-muted me-2"></i>
                                            {{ $data->capacity ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-calendar-alt text-muted me-2"></i>
                                            {{ $data->schedule ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge rounded-pill px-3 py-2 {{ $data->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($data->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('classroom.chapters', $data->id) }}">
                                                    <i class="fas fa-eye me-2"></i>View Details
                                                </a></li>
                                                {{-- <li><a class="dropdown-item" href="#">
                                                    <i class="fas fa-edit me-2"></i>Edit Class
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">
                                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                                </a></li> --}}
                                            </ul>
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
    
    <!-- Pagination Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ $classes->links() }}
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0 text-muted">Showing page {{ $classes->currentPage() }} of {{ $totalPages }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar {
        width: 32px;
        height: 32px;
        display: inline-flex;
    }
    
    .avatar-initial {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }
    
    .class-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
    }
    
    /* Bootstrap pagination customization */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-item.active .page-link {
        background-color: #696cff;
        border-color: #696cff;
    }
    
    .page-link {
        color: #696cff;
    }
    
    .page-link:hover {
        color: #5f61e6;
    }
</style>
@endsection