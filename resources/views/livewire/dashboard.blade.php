<div>
    <h1>Welcome to CustomerService</h1>
    <p>Please enter your query to continue</p>

    <form wire:submit.prevent="submitQuery">
        <div class="form-group">
            <label for="query">Enter your query:</label>
            <input type="text" class="form-control" id="query" wire:model="query" placeholder="Type your query here..." required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    @if(isset($response['error']))
        <div class="mt-4">
            <h4>Error:</h4>
            <p>{{ $response['error'] }}</p>
        </div>
    @elseif(isset($response))
        <div class="mt-4">
            <h4>Response:</h4>
            <p>{{ $response }}</p>
        </div>
    @endif
</div>
