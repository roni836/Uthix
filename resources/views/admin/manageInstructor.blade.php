@extends('admin.layout')
@section('title', 'Manage Instructor')
@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Hoverable Table rows -->
        <div class="card">
            <h5 class="card-header">Manage Instructors</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($instructors->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center mt-5">
                                    No Data found
                                </td>
                            </tr>
                        @else
                            @foreach ($instructors as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}.</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-status"
                                                id="update-status-btn-{{ $item->user->id }}" data-id="{{ $item->user->id }}"
                                                {{ $item->user->is_verified ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ti ti-pencil me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ti ti-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <!--/ Hoverable Table rows -->


    </div>
    <!-- / Content -->

    <script>
        $(document).on('change', '.toggle-status', function() {
            let id = $(this).data('id');
            let status = $(this).prop('checked') ? 1 : 0; // Get checkbox state
            let token = localStorage.getItem("auth_token");
    
            if (!token) {
                console.error("Authorization token is missing.");
                return;
            }
    
            $.ajax({
                type: 'PUT',
                url: `{{ url('/api/update-status') }}/${id}`,
                data: JSON.stringify({ status: status }), // Send data as JSON
                contentType: "application/json", // Ensure correct content type
                headers: {
                    "Authorization": "Bearer " + token
                },
                success: function(response) {
                    console.log(response);
                    swal("Success", response.message, "success");
                },
                error: function(xhr, status, error) {
                    console.error('Error updating status:', xhr.responseText);
                }
            });
        });
    </script>
    


    <!-- / Navbar -->

    <!-- Content wrapper -->

@endsection
