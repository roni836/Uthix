@extends('admin.layout')
@section('title', 'Manage Help Desk Queries')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Help Desk Queries Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Help Desk Queries</h5>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($queries as $query)
                        <tr>
                            <td>{{ $query->user->name }}</td>
                            <td>{{ Str::limit($query->subject, 50) }}</td>
                            <td>{{ Str::limit($query->description, 50) }}</td>
                            
                            <!-- Status with Badges -->
                            <td>
                                @if($query->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($query->status == 'resolved')
                                    <span class="badge bg-success">Resolved</span>
                                @elseif($query->status == 'closed')
                                    <span class="badge bg-danger">Closed</span>
                                @endif
                            </td>

                            <!-- Open Modal Button -->
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editQueryModal{{ $query->id }}">
                                    <i class="ti ti-edit"></i> Edit
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Query Modal -->
                        <div class="modal fade" id="editQueryModal{{ $query->id }}" tabindex="-1" aria-labelledby="editQueryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Query Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update.query.status', $query->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                        
                                            <div class="mb-3">
                                                <label class="form-label">Subject:</label>
                                                <p class="subject-box">{{ $query->subject }}</p>
                                            </div>
                        
                                            <div class="mb-3">
                                                <label class="form-label">Description:</label>
                                                <p class="description-box">{{ $query->description }}</p>
                                            </div>
                        
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Update Status:</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="pending" {{ $query->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="resolved" {{ $query->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                    <option value="closed" {{ $query->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                            </div>
                        
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- End Edit Modal -->
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Help Desk Queries Table -->

</div>
<style>
    .modal-body p {
    max-height: 150px; 
    overflow-y: auto;
    word-wrap: break-word;
    white-space: pre-wrap;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f8f9fa;
}
.modal-dialog {
    max-width: 70%; /* Adjust width as needed */
    width: 70%;
}


</style>
@endsection
