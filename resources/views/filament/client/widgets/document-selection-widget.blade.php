<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-6">
            <!-- Приветствие -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    👋 Привет, {{ auth('client')->user()->name ?? 'Клиент' }}!
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Давайте подготовим ваше предприятие к проверке Роспотребнадзора
                </p>
            </div>

            <!-- Базовый пакет документов -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">📋</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                            БАЗОВЫЙ ПАКЕТ ДОКУМЕНТОВ
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Обязательный минимум для любого пищевого предприятия (по ТР ТС 021/2011)
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Что входит:</h4>
                            <ul class="space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <li class="flex items-center">
                                    <span class="text-green-500 mr-2">✅</span>
                                    Программа производственного контроля
                                </li>
                                <li class="flex items-center">
                                    <span class="text-green-500 mr-2">✅</span>
                                    12 обязательных журналов
                                </li>
                                <li class="flex items-center">
                                    <span class="text-green-500 mr-2">✅</span>
                                    8 инструкций для персонала
                                </li>
                                <li class="flex items-center">
                                    <span class="text-green-500 mr-2">✅</span>
                                    5 приказов и положений
                                </li>
                                <li class="flex items-center">
                                    <span class="text-green-500 mr-2">✅</span>
                                    Чек-лист для самопроверки
                                </li>
                            </ul>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Время заполнения: ~30 минут
                            </p>
                        </div>
                        
                        <x-filament::button
                            tag="a"
                            href="#"
                            color="primary"
                            size="lg"
                            icon="heroicon-o-arrow-right"
                        >
                            Начать заполнение
                        </x-filament::button>
                    </div>
                </div>
            </div>

            <!-- План ХАССП (заглушка) -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 p-6 opacity-75">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">🎯</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400 mb-2">
                            ПЛАН ХАССП
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            Требуется для предприятий с высоким риском
                        </p>
                        
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <span class="mr-2">🔒</span>
                            <span>Доступен после заполнения базового пакета документов</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Помощь эксперта -->
            <div class="text-center">
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    📞 Нужна помощь?
                </p>
                <x-filament::button
                    tag="a"
                    href="#"
                    color="gray"
                    size="sm"
                    icon="heroicon-o-phone"
                >
                    Связаться с экспертом
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
