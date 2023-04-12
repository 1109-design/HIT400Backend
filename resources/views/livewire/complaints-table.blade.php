<div wire:poll>
    <div class="container-fluid" id="container-wrapper">
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Complaint ID</th>
                    <th>Reported By</th>
                    <th>Category</th>
                    <th>Reported On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($complaints as $complaint)
                    <tr>
                        <td><a href="#">#{{$complaint->id}}</a></td>
                        <td>{{ucwords($complaint->full_name)}}</td>
                        <td>{{$complaint->category}}</td>
                        <td>  {{$complaint->created_at}}</td>
                        <td><span
                                @if($complaint->status == 'Pending')
                                    class="badge badge-primary">
                                @elseif($complaint->status == 'Work In Progress')
                                    class="badge badge-warning">
                                @elseif($complaint->status == 'Completed')
                                    class="badge badge-warning">
                                @elseif($complaint->status == 'Resolved')
                                    class="badge badge-success">
                                @endif

                                {{$complaint->status}}

                            </span></td>

                        <td>
                            <a href="#" class="btn btn-sm btn-round btn-outline-primary">
                                <i class="fas fa-fw fa-phone"></i>
{{--                                Call Reporter--}}
                            </a>
                            <a href="{{route('complaint-location', ['id' => $complaint->id])}}" class="btn btn-sm btn-round btn-outline-primary">
                                <i class="fas fa-fw fa-map-pin"></i>

                                View Location</a>
                            <button type="button" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top"
                                    title="Edit"
                                    data-id="{{$complaint->id}}"
                                    onclick="updateStatus(this)">
                                <i class="fas fa-fw fa-upload"></i>
                                Update Status
                            </button>
                            <a href="{{route('download-attachment', ['id' => $complaint->id])}}" class="btn btn-sm btn-round btn-outline-success">
                                <i class="fas fa-fw fa-download"></i>

                                Download </button>

                        </td>
                    </tr>
                @empty
                    <tr>

                        <td></td>
                        <td></td>
                        <td><b>No complaints found</b></td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            {{--            {{ $complaints->links() }}--}}

        </div>

    </div>

</div>
