<?php

return [
    'pages' => [
        'auth' => [
            'login' => [
                'title' => 'Вход',
                'form' => [
                    'email' => [
                        'label' => 'Email',
                    ],
                    'password' => [
                        'label' => 'Пароль',
                    ],
                    'remember' => [
                        'label' => 'Запомнить меня',
                    ],
                    'actions' => [
                        'authenticate' => [
                            'label' => 'Войти',
                        ],
                    ],
                ],
                'actions' => [
                    'request_password_reset' => [
                        'label' => 'Забыли пароль?',
                    ],
                ],
            ],

            'register' => [
                'title' => 'Регистрация',
                'form' => [
                    'name' => [
                        'label' => 'Имя',
                    ],
                    'email' => [
                        'label' => 'Email',
                    ],
                    'password' => [
                        'label' => 'Пароль',
                    ],
                    'password_confirmation' => [
                        'label' => 'Подтверждение пароля',
                    ],
                    'actions' => [
                        'register' => [
                            'label' => 'Зарегистрироваться',
                        ],
                    ],
                ],
            ],

            'email_verification' => [
                'title' => 'Подтверждение email',
            ],
            'request_password_reset' => [
                'title' => 'Восстановление пароля',
            ],
            'reset_password' => [
                'title' => 'Смена пароля',
            ],
        ],
    ],
];
