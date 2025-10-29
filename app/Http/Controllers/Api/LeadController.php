<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255|regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/',
            'company_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
            'password_confirmation' => 'required|string|same:password',
            'action' => 'required|string|in:register,login,contact,demo,newsletter',
            'source' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ], [
            'name.required' => 'Имя обязательно для заполнения',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Проверьте формат email адреса',
            'phone.required' => 'Телефон обязателен для заполнения',
            'phone.regex' => 'Введите корректный номер телефона (11 цифр, начинается с 7)',
            'company_name.required' => 'Название компании обязательно для заполнения',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password_confirmation.required' => 'Подтверждение пароля обязательно для заполнения',
            'password_confirmation.same' => 'Пароли не совпадают',
            'action.required' => 'Действие обязательно для заполнения',
            'action.in' => 'Недопустимое действие',
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

        // Пароль будет автоматически захеширован в модели ClientUser
        // Не хешируем пароль здесь, так как модель ClientUser автоматически хеширует его

        // Удаляем password_confirmation, так как он не нужен в БД
        unset($data['password_confirmation']);

        // Добавляем IP адрес
        $data['ip_address'] = $request->ip();

        try {
            // Создаем заявку в базе данных
            $lead = Lead::create($data);

            // Если это регистрация, создаем клиентского пользователя
            if ($data['action'] === 'register' && !empty($data['email']) && !empty($data['password'])) {
                $clientUser = \App\Models\ClientUser::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'],
                    'password' => $data['password'], // Будет автоматически захеширован в модели
                    'email_verified_at' => now(),
                ]);

                // Логируем успешное создание
                Log::info('Lead and ClientUser created successfully', [
                    'lead_id' => $lead->id,
                    'client_user_id' => $clientUser->id,
                    'action' => $data['action'],
                    'source' => $data['source'] ?? 'unknown',
                    'ip' => $data['ip_address']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Регистрация завершена успешно! Теперь вы можете войти в личный кабинет.',
                    'lead_id' => $lead->id,
                    'client_user_id' => $clientUser->id,
                    'redirect_url' => '/client/login'
                ]);
            }

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
