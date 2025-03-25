@extends('admin.layout')
@section('title', 'Manage Plan')
@section('content')

    

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Classes</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Duration</th>
                                            <th>Features</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($plans as $plan)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">{{ $plan->name }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{ $plan->description ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">₹{{ number_format($plan->price, 2) }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{ ucfirst($plan->duration) }}</span> {{-- Capitalize Monthly/Yearly --}}
                                            </td>
                                            <td>
                                                @php 
                                                    $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true);
                                                @endphp
                                                
                                                @if(!empty($features) && is_array($features))
                                                    <ul>
                                                        @foreach($features as $feature)
                                                            <li>{{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="fw-medium text-danger">No Features</span>
                                                @endif
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status" data-id="{{ $plan->id }}" {{ $plan->status ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            
                                            <script>
                                                $(document).on('change', '.toggle-status', function () {
                                                    let planId = $(this).data('id');
                                                    let status = $(this).prop('checked') ? 1 : 0;
                                                    let token = "{{ csrf_token() }}";
                                            
                                                    $.ajax({
                                                        type: "PUT",
                                                        url: "/toggle-publish/" + planId,
                                                        data: { _token: token, status: status },
                                                        success: function (response) {
                                                            swal("Success", "Plan status updated!", "success");
                                                        },
                                                        error: function () {
                                                            swal("Error", "Something went wrong!", "error");
                                                        }
                                                    });
                                                });
                                            </script>
                                            
                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    {{-- <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('plans.show', $plan->id) }}">
                                                            <i class="ti ti-eye me-1"></i> View Details
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('plans.edit', $plan->id) }}">
                                                            <i class="ti ti-pencil me-1"></i> Edit
                                                        </a>
                                                        <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this plan?')">
                                                                <i class="ti ti-trash me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div> --}}
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
                    <!-- / Content -->
                  
@endsection
<style>
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
</style>