@extends('admin.layout')
@section('title', 'Manage Classes')

@section('content')
<div class="container-fluid py-4">
    <!-- Classroom Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-lg border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1">{{ $classroom->class_name }}</h2>
                            <p class="mb-0 opacity-8">{{ $classroom->subject->name ?? 'N/A' }} • Section {{ $classroom->section }}</p>
                        </div>
                        <div class="d-flex">
                           <a href="{{route('manage.class')}}"> <button class="btn btn-light me-2">
                            <i class="fas fa-arrow-right me-2"></i>Go Back
                        </button></a>
                            @if($classroom->link)
                                <a href="{{ $classroom->link }}" target="_blank" class="btn btn-success">
                                    <i class="fas fa-video me-2"></i>Join Class
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Classroom Info -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Class Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <span class="d-block text-muted small text-uppercase">Instructor</span>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="avatar-circle bg-primary text-white me-3">
                                        {{ substr($classroom->instructor->name ?? 'N/A', 0, 1) }}
                                    </div>
                                    <span class="fs-5">{{ $classroom->instructor->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <span class="d-block text-muted small text-uppercase">Status</span>
                                <div class="mt-2">
                                    <span class="badge px-3 py-2 fs-6 {{ $classroom->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($classroom->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <span class="d-block text-muted small text-uppercase">Schedule</span>
                                <div class="mt-2 d-flex align-items-center">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <span class="fs-5">{{ $classroom->schedule ? \Carbon\Carbon::parse($classroom->schedule)->format('d M Y, h:i A') : 'Not Scheduled' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="info-item">
                                <span class="d-block text-muted small text-uppercase">Capacity</span>
                                <div class="mt-2 d-flex align-items-center">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <span class="fs-5">{{ $classroom->capacity }} Students</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="info-item">
                                <span class="d-block text-muted small text-uppercase">Description</span>
                                <div class="mt-2 p-3 bg-light rounded">
                                    <p class="mb-0">{{ $classroom->description ?? 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Class Details</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Created On</span>
                            <span class="badge bg-light text-dark">{{ $classroom->created_at->format('d M Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Class ID</span>
                            <span class="badge bg-light text-dark">{{ $classroom->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Section</span>
                            <span class="badge bg-light text-dark">{{ $classroom->section }}</span>
                        </li>
                        @if($classroom->link)
                        <li class="list-group-item px-0">
                            <span class="text-muted mb-2 d-block">Class Link</span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" value="{{ $classroom->link }}" readonly>
                                <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $classroom->link }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Chapters Section -->
    <div class="row">
        {{-- <div class="col-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Chapters</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Chapter
                </button>
            </div>
        </div> --}}

        @if(count($classroom->chapters) > 0)
            @foreach ($classroom->chapters as $chapter)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card chapter-card h-100 shadow-sm hover-shadow border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-primary">Chapter {{ $loop->iteration }}</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <h5 class="card-title">{{ $chapter->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($chapter->description, 100) }}</p>
                        
                        <div class="d-flex mt-3">
                            @if($chapter->date)
                            <div class="me-3">
                                <small class="text-muted d-block">Date</small>
                                <span class="d-inline-block"><i class="far fa-calendar me-1"></i>{{ $chapter->date }}</span>
                            </div>
                            @endif
                            
                            @if($chapter->time)
                            <div>
                                <small class="text-muted d-block">Time</small>
                                <span class="d-inline-block"><i class="far fa-clock me-1"></i>{{ $chapter->time }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center py-5">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon mb-3">
                                <i class="fas fa-book-open fa-3x text-muted"></i>
                            </div>
                            <h4>No Chapters Found</h4>
                            <p class="text-muted">This classroom doesn't have any chapters yet.</p>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add First Chapter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.info-item {
    height: 100%;
}

.hover-shadow {
    transition: all 0.3s;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.chapter-card {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.empty-state {
    padding: 2rem 0;
}

.empty-state-icon {
    background-color: #f8f9fa;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

/* For the copy link functionality */
function copyToClipboard(text) {
    const input = document.createElement('input');
    input.value = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    
    // Optionally show a tooltip or notification
    alert('Link copied to clipboard!');
}
</style>
@endsection