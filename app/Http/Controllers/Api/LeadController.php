<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Логируем входящие данные для отладки
        Log::info('Lead API request received', [
            'data' => $request->all(),
            'ip' => $request->ip()
        ]);
        
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|max:255',
            'password_confirmation' => 'nullable|string|same:password',
            'action' => 'required|string|in:register,login,contact,demo,newsletter',
            'source' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации данных',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Проверяем наличие email или телефона
        if (empty($data['email']) && empty($data['phone'])) {
            return response()->json([
                'success' => false,
                'message' => 'Email или телефон обязателен для заполнения'
            ], 422);
        }

        // Очищаем телефон от лишних символов
        if (!empty($data['phone'])) {
            $data['phone'] = preg_replace('/[^0-9+]/', '', $data['phone']);
        }

        // Хешируем пароль, если он указан
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        // Удаляем password_confirmation, так как он не нужен в БД
        unset($data['password_confirmation']);

        // Добавляем IP адрес
        $data['ip_address'] = $request->ip();

        try {
            // Создаем заявку в базе данных
            $lead = Lead::create($data);

            // Логируем успешное создание
            Log::info('Lead created successfully', [
                'lead_id' => $lead->id,
                'action' => $data['action'],
                'source' => $data['source'] ?? 'unknown',
                'ip' => $data['ip_address']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Заявка успешно отправлена',
                'lead_id' => $lead->id
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Error creating lead', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при обработке заявки'
            ], 500);
        }
    }
}
