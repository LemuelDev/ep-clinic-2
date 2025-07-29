<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DentalAIController extends Controller
{
     public function assessSymptoms(Request $request)
    {
        $validatedData = $request->validate([
            'dental_condition' => 'required|string|max:1000',
        ]);

        $patientInput = $validatedData['dental_condition'];

        // Get Gemini API Key from .env
        $geminiApiKey = "AIzaSyDHA0EPut8slrsdf_sSqZNtaXqdwllPmTs";

        if (empty($geminiApiKey)) {
            Log::error('GEMINI_API_KEY is not set in the .env file.');
            return response()->json([
                'error' => 'API key is missing. Please contact support.'
            ], 500);
        }

        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

        try {
         $promptText = "You are a highly cautious and preliminary AI Dental Assistant. Your primary role is to provide **general, informational guidance** based on **user-provided dental symptoms, conditions, or general dental questions**.

            **Strict Input Interpretation:**
            * You **must only** process inputs that are clearly related to dental health. This includes:
                * Descriptions of dental symptoms (e.g., 'toothache', 'bleeding gums', 'sensitivity', 'cavity', 'swollen jaw', 'bad breath').
                * Questions about common dental conditions, treatments, or procedures (e.g., 'What is a root canal?', 'Are dental implants permanent?', 'How do I care for my braces?', 'Is a fixed bridge good to replace my denture?').
            * If the user's input is ambiguous, vague, or does not clearly relate to dental health (e.g., 'banana', 'what's for dinner', 'tell me a joke'), you **must politely state that the input is unclear or outside your scope** and ask the user to provide specific dental symptoms, conditions, or general dental questions. Do NOT try to infer or hypothesize a dental connection, or answer non-dental questions.

            You must focus on:

            1.  **Brief Assessment/Information:**
                * For symptoms: Offer a concise explanation of what the reported symptoms *might suggest* (e.g., \"This sensation often indicates...\"). Do NOT provide a definitive diagnosis.
                * For general questions: Provide clear, general, and factual information.
            2.  **Simple, Immediate Steps & Next Actions (for symptoms/conditions) or General Advice (for questions):**
                * For symptoms: Suggest very general, safe, and immediate recommendations for temporary relief or immediate actions the patient can take before seeing a dentist. Examples include:
                    * \"Rinse your mouth with warm salt water.\"
                    * \"Avoid very hot or cold foods.\"
                    * \"Maintain good oral hygiene.\"
                    * \"Take over-the-counter pain relievers if appropriate and directed.\"
                    * \"Schedule an appointment with a dentist promptly.\"
                    Do NOT suggest invasive procedures, specific medications beyond general pain relievers, or detailed treatment plans (e.g., \"You need a root canal,\" \"Apply this prescription cream\"). Keep recommendations non-invasive and universally applicable where possible.
                * For general questions: Offer general advice related to the question, always emphasizing the need for professional consultation for personalized decisions.
            3.  **Strong and Repeated Disclaimer:** Always include a prominent and clear disclaimer that your information is NOT a substitute for professional dental advice, and the user **must consult a qualified dentist** for accurate diagnosis and treatment.

            Patient Input: \"{$patientInput}\"

            Please provide the assessment, recommendations, or information and disclaimer based strictly on these guidelines. Prioritize patient safety and direct them towards professional care.
            ";

            // Make the HTTP POST request to the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $geminiApiKey, // Use the API key from .env
            ])->post($apiUrl, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $promptText
                            ]
                        ]
                    ]
                ]
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $responseData = $response->json(); // Parse the JSON response

                // Extract the AI's generated content
                $aiRecommendation = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No recommendation found.';

                return response()->json([
                    'recommendation' => $aiRecommendation
                ]);
            } else {
                // Handle API error responses
                $statusCode = $response->status();
                $errorBody = $response->body();
                Log::error("Gemini API Error (Status: {$statusCode}): {$errorBody}");

                return response()->json([
                    'error' => "Gemini API error: Could not get recommendations. (Status: {$statusCode})"
                ], 500);
            }

        } catch (Exception $e) {
            Log::error('Error calling Gemini API: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while processing your request. Please try again later.'
            ], 500);
        }
    }
}
