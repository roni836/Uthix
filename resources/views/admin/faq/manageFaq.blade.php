@extends('admin.layout')
@section('title', 'Manage FAQs')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- FAQ Management Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Manage FAQs</h5>
            <a href="{{route('insert.faq')}}" class="text-white">
                <button type="submit" class="btn btn-primary hover" data-bs-toggle="modal" data-bs-target="#default-modal">
                    Add New FAQ
                </button>
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($faqs as $faq)
                        <tr>
                            <td><span class="fw-medium">{{ Str::limit($faq->question, 80) }}</span></td>
                            <td><span class="fw-medium">{{ Str::limit($faq->answer ?? 'N/A', 80) }}</span></td>
                            
                            
                            <!-- Toggle FAQ Status -->
                            <td>
                                <form action="{{ route('toggle.faq.status', $faq->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label class="switch">
                                        <input type="checkbox" name="status" onchange="this.form.submit()" {{ $faq->status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    {{-- <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('faqs.edit', $faq->id) }}">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this FAQ?')">
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
    <!--/ FAQ Management Table -->

</div>
<!-- / Content -->

@endsection

<!-- Toggle Switch Styles -->
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
