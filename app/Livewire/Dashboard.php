<?php

namespace App\Livewire;

use App\Http\Controllers\GeminiController;
use Livewire\Component;

class Dashboard extends Component
{
    public $query;
    public $response;

    public function submitQuery()
    {
        // Create an instance of GeminiController
        $geminiController = new GeminiController();

        // Capture the query from the component's public property
        $query = $this->query;

        // Validate the query (optional, depending on your requirements)
        if (!$query) {
            $this->response = ['error' => 'Query parameter is required'];
            return; // Exit the method early if no query is provided
        }

        try {
            // Call the query method on the GeminiController, passing the query input
            $response = $geminiController->query($query);

            // Process the response
            if (isset($response['contents'][0]['parts'][0]['text'])) {
                $this->response = $response['contents'][0]['parts'][0]['text']; // Assuming response structure from Gemini API
            } else {
                $this->response = ['error' => 'Failed to fetch valid response from Gemini API'];
            }
        } catch (\Exception $e) {
            $this->response = ['error' => $e->getMessage()];
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
