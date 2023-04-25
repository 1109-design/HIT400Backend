<div wire:poll>
    <div class="form-group">
        <input type="text" class="form-control" wire:model="search" placeholder="Search...">
    </div>
    <div class="form-group">
        <select class="form-control" wire:model="filter">
{{--            <option value="">All</option>--}}
            <option value="Urgency">Urgency</option>
            <option value="Neutral">Neutral</option>
            <option value="Negative">Negative</option>
{{--            <option value="Resolved">Resolved</option>--}}
        </select>
    </div>
    <div class="container-fluid" id="container-wrapper">
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Complaint ID</th>
                    <th>Reported By</th>
                    <th>Category</th>
                    <th>Reported On</th>
                    <th>Sentiment</th>
                    <th>Sentiment Score</th>
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
                         <td>{{$complaint->sentiment ?? "____"}}</td>
                    <td><div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$complaint->score ?? 0}}%" aria-valuenow= "{{$complaint->score ?? 0}}"
                      aria-valuemin="0" aria-valuemax="100">{{$complaint->score ?? 0}}%</div>
                  </div></td>
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
                            {{-- <a href="#" class="btn btn-sm btn-round btn-outline-primary">
                                <i class="fas fa-fw fa-phone"></i>

                            </a> --}}
                            <a href="{{route('complaint-location', ['id' => $complaint->id])}}" class="btn btn-sm btn-round btn-outline-primary">
                                <i class="fas fa-fw fa-map-pin"></i>

                                View Location</a>
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top"
                                    title="Edit"
                                    data-id="{{$complaint->id}}"
                                    onclick="updateStatus(this)">
                                <i class="fas fa-fw fa-upload"></i>
                                Update Status
                            </button>
                            <a href="{{route('download-attachment', ['id' => $complaint->id])}}" class="btn btn-sm btn-round btn-outline-success">
                                 Download
                                <i class="fas fa-fw fa-download">

                                </i>
                            </a>



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




        </div>

    </div>
    {{ $complaints->links() }}

</div>
