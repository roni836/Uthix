@extends('admin.layout')
@section('title', 'Manage Products')
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
                                            <th>Subject</th>
                                            <th>Section</th>
                                            <th>Capacity</th>
                                            <th>Scchedule</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($classes as $data)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">{{$data->class_name}}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{$data->subject->name}}</span>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{$data->section ?? 'NUll'}}</span>
                                               
                                            </td>

                                             <td>
                                                <span class="fw-medium">{{$data->capacity ?? 'NULL'}}</span>
                                            </td>

                                             <td>
                                                <span class="fw-medium">{{$data->schedule ?? 'NULL'}}</span>
                                            </td>

                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ti ti-pencil me-1"></i>View detail</a>
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
                    <!-- / Content -->
                  
@endsection
