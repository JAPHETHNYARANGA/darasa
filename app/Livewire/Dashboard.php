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

        $query = $this->query;

        if (!$query) {
            $this->response = ['error' => 'Query parameter is required'];
            return; 
        }

        try {
            // Setting response to null to clear previous response before fetching new one
            $this->response = null;

            $response = $geminiController->query($query);

            if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
                $this->response = $this->processResponse($response['candidates'][0]['content']['parts'][0]['text']);
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

    private function processResponse($text)
    {
        // Remove *** marks and split questions by **
        $text = str_replace('***', '', $text);
        $parts = explode('**', $text);

        // Clean up empty parts and trim each question
        $questions = array_map('trim', array_filter($parts));

        return $questions;
    }
}
