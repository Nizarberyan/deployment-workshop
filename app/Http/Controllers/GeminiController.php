<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Resources\Content;
use Gemini\Enums\Role;
use Google\Cloud\Core\ExponentialBackoff;

class GeminiController extends Controller
{
    public function index(): View
    {
        return view('gemini.conversation');
    }

    public function chat(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'message' => 'required|string',
            ]);
            
            // Get the message from the request
            $message = $validated['message'];
            
            // Initialize Gemini client using environment variables
            $apiKey = env('GEMINI_API_KEY');
            
            if (!$apiKey) {
                Log::error('Gemini API key not found');
                return response()->json(['error' => 'API key configuration missing'], 500);
            }
            
            // Log request information for debugging
            Log::info('Sending request to Gemini API', ['message' => $message]);
            
            // Make the request to Gemini API
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=' . $apiKey, [
                'json' => [
                    'contents' => [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ]
            ]);
            
            // Parse and return the response
            $responseBody = json_decode($response->getBody(), true);
            Log::info('Received response from Gemini API', ['response' => $responseBody]);
            
            return response()->json([
                'response' => $responseBody['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from AI'
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in Gemini chat endpoint', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return a user-friendly error
            return response()->json(['error' => 'An error occurred processing your request'], 500);
        }
    }

    public function clearHistory(): JsonResponse
    {
        Session::forget('gemini_history');
        return response()->json(['status' => 'success']);
    }

    public function testApi()
    {
        try {
            // Test with the new model name "gemini-2.0-flash"
            $result = Gemini::generativeModel('gemini-2.0-flash')->generateContent('what is "fin a3chiri"');
            return response()->json([
                'success' => true,
                'message' => $result->text()
            ]);
        } catch (\Exception $e) {
            Log::error('Test API Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
