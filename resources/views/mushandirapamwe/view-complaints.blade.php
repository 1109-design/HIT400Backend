@extends('layouts.app')
@section('page-css')
    @livewireStyles

    <style>
        #imageContainer {
  position: relative;
}

#image {
  max-width: 100%;
  height: auto;
}

#canvas {
  position: absolute;
  top: 0;
  left: 0;
}

.progress {
  margin-top: 10px;
}


    </style>

    <style>

    </style>
    @endsection
    @section('content')
        <!DOCTYPE html>
    <html>
    <head>
        {{--        <title>Laravel Livewire Example - ItSolutionStuff.com</title>--}}
        @livewireStyles
        <style>
            b {
                text-decoration: overline underline;
                -webkit-text-decoration-color: #8ebf42;
                text-decoration-color: #8ebf42;
                color: #8ebf42;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        {{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.0/tailwind.min.css" integrity="sha512-wOgO+8E/LgrYRSPtvpNg8fY7vjzlqdsVZ34wYdGtpj/OyVdiw5ustbFnMuCb75X9YdHHsV5vY3eQq3wCE4s5+g==" crossorigin="anonymous" />--}}
        <style>
            .modal {
                /* Modal styles here */
            }

            /* Create a semi-transparent overlay */
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px); /* Apply a blur effect */
                z-index: 1;
            }

        </style>
    </head>
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h1>  {{$status}} Complaints</h1>
                </li>
            </ol>
        </nav>
    </div>
    {{--    @livewire('complaints-table')--}}
    <!-- Modal --><!-- Modal -->
    <form action="{{route('update-status')}}" method="post" enctype="multipart/form-data" id="myForm">
        @csrf
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg animated bounceInDown" role="document">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Update Complaint Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="complaint-id" id="complaint-id">
                        {{--                        <form>--}}
                        <div class="form-group animated fadeInLeft">
                            <label for="statusSelect">Select Your Status</label>
                            <select class="form-control" id="statusSelect" name="status">
                                <option>Work In Progress</option>
                                <option>Completed</option>
                                <option>On Hold</option>
                            </select>
                            <label for="comments">Leave your comment here:</label><br>
                            <textarea class="form-control" id="comments" name="comments" rows="4" cols="50"></textarea>
                        </div>
                        {{--                        </form>--}}
                    </div>
                    <div class="modal-footer animated fadeInUp">
                        {{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
                        <button type="submit" class="btn btn-primary" id="myButton" onclick="disableButton()">Update
                            Status
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal" id="callHistory" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
         aria-hidden="true">
        <h1>Call History</h1>
        <div class="modal-content">
            <ul>
                <li>
                    <i class="fas fa-user"></i>
                    <span>John Doe</span>
                    <span>1 hour ago</span>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>Jane Doe</span>
                    <span>3 hours ago</span>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>Jack Doe</span>
                    <span>Yesterday</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <!-- Container Fluid-->
        <div class="col-md-12">
            @livewire('complaints-table', ['status' => $status])


        </div>

    </div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image Analysis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="imageContainer">
          <img id="image" src="">
          <canvas id="canvas"></canvas>
        </div>
        <div class="progress">
          <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="surveyInfoModal" tabindex="-1" aria-labelledby="surveyInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surveyInfoModalLabel">Road Damage Survey Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <p><strong>Surveyor Name:</strong> <span id="surveyorName"></span></p>
        <p><strong>Survey Date:</strong> <span id="surveyDate"></span></p>
        <p><strong>Severity Level:</strong> <span id="severityLevel"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    </html>


@endsection

@section('page-js')
    @livewireScripts
    <script>

        function updateStatus(complaint) {
            $('#complaint-id').val($(complaint).attr('data-id'))
            $('#statusModal').modal('show')

        }

    </script>
    <script>
        document.addEventListener("livewire:load", function () {
            Livewire.on('refreshComponent', function () {
                Livewire.emitSelf('$refresh');
            });
        });
    </script>
    <script>
        function disableButton() {
            var form = document.getElementById("myForm");
            form.submit();
            document.getElementById("myButton").innerHTML = "Please wait...";
            document.getElementById("myButton").disabled = true;

        }
    </script>

    <script>
   // Open the image modal and start the image analysis
function openImageModal(imageUrl) {

  // Set the image source and show the modal
  $('#image').attr('src', imageUrl);
  $('#imageModal').modal('show');

  // Start the progress bar
  var progressBar = $('#progressBar');
  var progress = 0;
  var progressText = $('#progressText');
  progressText.text('0%');
  var analyzingMessage = $('#analyzingMessage');
  analyzingMessage.text('Analyzing...');
  var timer = setInterval(function() {
    progress += 10;
    progressBar.css('width', progress + '%');
    progressBar.attr('aria-valuenow', progress);
    progressText.text(progress + '%');
    if (progress >= 100) {
      clearInterval(timer);
      progressBar.text("Analysis Complete");
      sendAjaxRequest();
       // Open modal with road damage survey information
  var modalContent = '<div class="modal-header">';
  modalContent += '<h5 class="modal-title">Road Damage Survey Results</h5>';
  modalContent += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
  modalContent += '</div>';
  modalContent += '<div class="modal-body">';
  modalContent += '<p>Survey Date: 01/01/2023</p>';
  modalContent += '<p>Surveyor: John Smith</p>';
  modalContent += '<p>Number of potholes: 10</p>';
  modalContent += '<p>Number of cracks: 15</p>';
  modalContent += '<p>Severity: High</p>';
  modalContent += '</div>';
  modalContent += '<div class="modal-footer">';
  modalContent += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
  modalContent += '</div>';

  var modal = $('#surveyModal');
  modal.find('.modal-content').html(modalContent);
  modal.modal('show');
    }
  }, 100);

  // Draw vertical text for width
  context.save();
  context.translate(canvas.width - 50, 20);
  context.rotate(Math.PI / 2);
  context.font = 'bold 16px Arial';
  context.fillStyle = 'red';
  context.fillText('Width: ' + image.width, 0, 0);
  context.restore();

  // Draw horizontal text for height
  context.save();
  context.font = 'bold 16px Arial';
  context.fillStyle = 'red';
  context.fillText('Height: ' + image.height, canvas.width - 100, canvas.height - 10);
  context.restore();
}



    </script>

    <script>
  function sendAjaxRequest() {
  // Get surveyor name and current date
  var surveyorName = '{{ Auth::user()->name }}';
  var currentDate = '{{ date("Y-m-d") }}';

  // Generate random severity level
  var severityLevels = ['low', 'medium', 'high'];
  var randomSeverity = severityLevels[Math.floor(Math.random() * severityLevels.length)];

  // Set modal content
  $('#surveyorName').text(surveyorName);
  $('#surveyDate').text(currentDate);
  $('#severityLevel').text(randomSeverity);

  // Show the modal
  $('#surveyInfoModal').modal('show');
}
</script>

@endsection
