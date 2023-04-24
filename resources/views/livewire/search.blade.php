<div>
    <div class="modal modal-dialog-slideout" id="search-modal" wire:ignore.self tabindex="-1" role="dialog"
        aria-labelledby="search-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-vertical-right my-custom-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="search-modal-label">Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search"
                                wire:model.lazy="searchTerm">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" wire:click="search">Search</button>
                            </div>
                        </div>
                        {{-- {{$searchTerm}} --}}
                    </form>


                    <hr>
                    <p>Predefined search suggestions: </p>
                    <div class="search-suggestions">
                        {{-- @foreach ($searchSuggestions as $suggestion) --}}
                        <button class="search-suggestion btn btn-sm btn-outline-primary"
                            wire:click.prevent="search('This is fire')">One suggestion</button>
                        {{-- @endforeach --}}

                    </div>
                    <hr>
                    <div wire:loading>
                        <button type="button" class="btn btn-primary" disabled>Generating results...</button>
                    </div>

                    <div class="search-results">
                        <p>Search results:
                            {{ $searchResults }}



                        </p>
                        <!-- Results will be displayed here -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
