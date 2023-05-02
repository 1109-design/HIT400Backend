@extends('layouts.app')

@section('page-css')
    @livewireStyles





    @endsection
    @section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advanced Analysis- Ask me anything </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex flex-column justify-content-center align-items-center bg-light">
    <div class="container">
        <div class="text-center py-4">
            <h5 class="display-1 fw-bold">Complaints Analysis</h5>
        </div>

      <div class="bg-white border border-2 border-gray-600 rounded p-4 min-h-[60px] h-full text-gray-600">
  <form action="/writer/generate" method="post" class="d-flex gap-2 w-100">
    @csrf
    <input required name="title" id="title-input" class="form-control form-control-lg fw-bold" value="{{ $title }}" placeholder="Type your question...">
    <button id="generate-button" class="btn btn-lg btn-success">Generate</button>
  </form>
</div>

<div class="search-suggestions">
  <button id="highlight-button" class="search-suggestion btn btn-sm btn-outline-primary">
    Highlight the major data highlights
  </button>
  <button id="category-button" class="search-suggestion btn btn-sm btn-outline-primary">
    Which category has more severe cases and recommend solutions
  </button>
</div>

        @if($content)
            <div class="bg-white border border-2 border-gray-600 rounded p-4 min-h-[720px] h-full text-gray-600 mt-4">
                <textarea class="form-control min-h-[500px]" spellcheck="false">{{ $content }}</textarea>
            </div>
        @endif
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
@section('page-js')
<script>
  const highlightButton = document.getElementById('highlight-button');
  const titleInput = document.getElementById('title-input');

  highlightButton.addEventListener('click', function() {
    const buttonText = highlightButton.textContent;
    titleInput.value = buttonText;
  });
</script>
<script>
  const catButton = document.getElementById('category-button');
  const titlecatInput = document.getElementById('title-input');

  catButton.addEventListener('click', function() {
    const buttonText = catButton.textContent;
    titlecatInput.value = buttonText;
  });
</script>
@endsection
