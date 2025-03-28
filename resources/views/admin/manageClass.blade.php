@extends('admin.layout')
@section('title', 'Manage Classes')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y mt-4">
    <h2 class="text-center text-dark mb-4 fw-bold">Manage Classes</h2>
    <div class="table-responsive bg-white p-4 shadow rounded">
        <table class="table table-striped align-middle text-center">
            <thead class=" text-gray">
                <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Instructor</th>
                    <th>Subject</th>
                    {{-- <th>Section</th> --}}
                    <th>Capacity</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $key=>$data)
                <tr>
                    <td><strong>{{ ($classes->currentPage() - 1) * $classes->perPage() + $key + 1 }}</strong></td>
                    <td><strong>{{ $data->class_name }}</strong></td>
                    <td>{{ $data->instructor->name }}</td>
                    <td>{{ $data->subject->name }}</td>
                    {{-- <td>{{ $data->section ?? 'N/A' }}</td> --}}
                    <td>{{ $data->capacity ?? 'N/A' }}</td>
                    <td>{{ $data->schedule ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $data->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('classroom.chapters', $data->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container mt-3 mb-3"> 
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 d-flex justify-content-lg-start justify-content-center mb-2 mb-lg-0">
                {{ $classes->links() }}
            </div>
            
            <div class="col-lg-6 text-lg-end text-center">
                Page {{ $classes->currentPage() }} of {{ $totalPages }}
            </div>
        </div>
    </div>
</div>

@endsection
