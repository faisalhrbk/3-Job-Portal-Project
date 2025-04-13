@extends('layouts.app')

@section('main')

    <section class="section-5 bg-2">

        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 mb-4 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('account.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('message')
                    <div class="card mb-4 border-0 p-3 shadow">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1"> Saved Jobs</h3>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Applied On</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobApplications->isNotEmpty())
                                            @foreach ($jobApplications as $jobApplication)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $jobApplication->job->title }}</div>
                                                        <div class="info1">{{ $jobApplication->job->jobType->name }} .
                                                            {{ $jobApplication->job->location }}
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->format('d M, Y') }}
                                                    </td>
                                                    <td>{{ $jobApplication->job->applications->count() }}</td>
                                                    <td>
                                                        @if ($jobApplication->job->status == 1)
                                                            <div class="job-status text-capitalize">Active</div>
                                                        @else
                                                            null
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-end">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('job.detail', $jobApplication->job->id) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        View</a></li>

                                                                <li><a class="dropdown-item" href="#"
                                                                        onclick="deleteJob({{ $jobApplication->id }}, event)"><i
                                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                                        Remove</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $jobApplications->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteJob(id, event) {
            event.preventDefault();
            if (confirm('Are you Sure You want to remove!!')) {
                $.ajax({
                    url: "{{ route('account.removeJob') }}",
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: (response) => {

                        window.location.href = "{{ route('account.myJobApplications') }}"
                    }
                });
            }
        }
    </script>
@endsection
