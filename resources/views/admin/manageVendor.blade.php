@extends('admin.layout')
@section('title', 'Manage Users')
@section('content')


                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <h5 class="card-header">Manage Vendors</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover text-capitalize">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            {{-- <th>dob</th> --}}
                                            <th>Store name </th>
                                            <th>Store Address</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @if ($vendors->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center mt-5">
                                                    No Data found
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($vendors as $i => $item)
                                                <tr>
                                                    <td>{{ $i + 1 }}.</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->gender }}</td>
                                                    {{-- <td>{{ $item->dob }}</td> --}}
                                                    <td>{{ $item->store_name }}</td>
                                                    <td>{{ $item->store_address }}</td>
                                                    {{-- <td>{{ $item->class }}</td> --}}
                                                    {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
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
                   

@endsection
