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

class GeminiController extends Controller
{
    public function index(): View
    {
        return view('gemini.conversation');
    }

    public function chat(Request $request): JsonResponse
    {
        try {
            $message = $request->input('message');
            Log::info('Received chat request', ['message' => $message]);

            // Get the existing history from the session
            $history = Session::get('gemini_history', []);

            // Initialize the chat history array for Gemini
            $chatHistory = [];

            // Convert session history to Gemini format
            if (!empty($history)) {
                // Log the history for debugging
                Log::info('Existing chat history', ['history' => $history]);

                // We'll skip history conversion for now since it might be causing issues
            }

            // Use the same approach as in the working testApi() method
            try {
                // Use the generativeModel approach that works in testApi
                $result = Gemini::generativeModel('gemini-2.0-flash')->generateContent($message);
                $aiResponse = $result->text();

                Log::info('Received Gemini response', ['response' => $aiResponse]);

                // Update the history in the session
                $history[] = ['role' => 'user', 'parts' => [['text' => $message]]];
                $history[] = ['role' => 'model', 'parts' => [['text' => $aiResponse]]];
                Session::put('gemini_history', $history);

                return response()->json(['response' => $aiResponse]);
            } catch (\Exception $apiError) {
                Log::error('API Communication Error', [
                    'message' => $apiError->getMessage(),
                    'code' => $apiError->getCode(),
                    'trace' => $apiError->getTraceAsString()
                ]);

                return response()->json([
                    'error' => 'Error communicating with Gemini API: ' . $apiError->getMessage()
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('General Gemini Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], 500);
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
