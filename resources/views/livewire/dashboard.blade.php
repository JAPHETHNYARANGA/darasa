<div>
    <h1>Welcome to CustomerService</h1>
    <p>Please enter your query to continue</p>

    <form wire:submit.prevent="submitQuery" wire:loading.class="loading">
        <div class="form-group">
            <label for="query">Enter your query:</label>
            <input type="text" class="form-control" id="query" wire:model="query" placeholder="Type your query here..." required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <div class="loader" wire:loading wire:target="submitQuery">
        Loading...
    </div>

    @if(isset($response['error']))
        <div class="mt-4">
            <h4>Error:</h4>
            <p>{{ $response['error'] }}</p>
        </div>
    @elseif(isset($response))
        <div class="mt-4" wire:loading.remove>
            <h4>Response:</h4>
            @foreach($response as $index => $question)
                <p><strong>{{ $index + 1 }}. {{ $question }}</strong></p>
            @endforeach
        </div>
    @endif
</div>
