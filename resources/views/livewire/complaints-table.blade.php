<div wire:poll>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <select class="form-control" wire:model="filter">
                    <option value="">All</option>
                    <option value="Urgency">Urgency</option>
                    <option value="Neutral">Neutral</option>
                    <option value="Negative">Negative</option>
                    <option value="Resolved">Resolved</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
      <table class="table align-items-center table-flush table-hover table-sm" style="font-size: 14px;">
            <thead class="thead-light">
                <tr>
                    <th>Complaint ID</th>
                    <th>Attachments</th>
                    <th>Reported By</th>
                    <th>Category</th>
                    <th>Reported On</th>
                    <th>Sentiment</th>
                    <th>Public Score</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $complaint)
                <tr @if($complaint->sentiment == 'Urgency') class="table-danger" @endif>
                    <td><a href="#">#{{$complaint->id}}</a></td>
                    <td @if($complaint->image_url and $complaint->category == 'Road Works') onclick="openImageModal('{{asset('storage/images/complaints/'.substr($complaint->image_url, strlen('public/images/complaints/')))}}')" @endif>
    @if($complaint->image_url)
        <a href="#">
            <img src="{{asset('storage/images/complaints/'.substr($complaint->image_url, strlen('public/images/complaints/')))}}" alt="No" style="width: 20%; height: 20%;">
        </a>
    @else
        <i class="fas fa-file-alt"></i> No Attachment
    @endif
</td>
                    <td>{{ucwords($complaint->full_name)}}</td>
                    <td>{{$complaint->category}}</td>
                    <td>{{ $complaint->created_at ? $complaint->created_at->format('M d, Y h:i a') : '__'  }}</td>
                    <td>{{$complaint->sentiment ?? "____"}}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar  bg-success" role="progressbar" style="width: {{$complaint->score ?? 0}}%" aria-valuenow="{{$complaint->score ?? 0}}" aria-valuemin="0" aria-valuemax="100">
                                {{$complaint->score ?? 0}}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ $complaint->status == 'Pending' ? 'primary' : ($complaint->status == 'Work In Progress' || $complaint->status == 'Completed' ? 'warning' : 'success') }}">
                            {{ $complaint->status }}
                        </span>
                    </td>

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
    <div>{{$complaints->links()}}</div>

</div>
