<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // <-- Añade esta línea

class AIController extends Controller
{
    public function handleQuery(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'context' => 'nullable|in:customers,inventory,sales'
        ]);

        try {
            $payload = [
                'chatInput' => $validated['question'],
                'context' => $validated['context'],
                'userId' => $request->user()?->id
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post(config('services.n8n.webhook'), $payload);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('AI Error: ' . $e->getMessage()); // <-- Ahora funciona
            return response()->json([
                'success' => false,
                'answer' => 'Error temporal. Intenta nuevamente.'
            ], 500);
        }
    }

    private function buildPrompt($question, $context)
    {
        $contextMap = [
            'customers' => 'Estás analizando el reporte de clientes. ',
            'inventory' => 'Estás analizando el reporte de inventario. ',
            'sales' => 'Estás analizando el reporte de ventas. '
        ];

        $basePrompt = "Eres un asistente especializado en análisis de datos para una tienda de ropa (Ssamanth Clothes Shein). ";
        $basePrompt .= $contextMap[$context] ?? '';
        $basePrompt .= "Responde de manera concisa y profesional. ";
        $basePrompt .= "Pregunta del usuario: " . $question;

        return $basePrompt;
    }
}