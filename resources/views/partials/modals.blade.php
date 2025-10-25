<!-- Модальное окно регистрации -->
<div id="registerModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3>Давай начнем!</h3>
            <p>Заполни форму, и мы создадим для тебя документы ХАССП</p>
        </div>
        <div class="form-success">
            Спасибо! Мы получили твою заявку и скоро свяжемся. Проверь почту - там будет письмо с инструкциями.
        </div>
        <form id="registerForm" class="modal-form" action="/api/leads" method="POST" onsubmit="return false;">
            <div class="form-group">
                <label for="name">Как тебя зовут?</label>
                <input type="text" id="name" name="name" placeholder="Имя" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="почта@domain.ru">
                <div class="form-error" id="emailError">Нужен корректный email или телефон</div>
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" placeholder="+7 (999) 123-45-67">
                <div class="form-error" id="phoneError">Проверь формат телефона</div>
            </div>
            <div class="form-group">
                <label for="company_name">Название компании</label>
                <input type="text" id="company_name" name="company_name" placeholder="Кафе 'Вкусно и точка'">
            </div>
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="source" id="source" value="unknown">
            @csrf
            <button type="submit" class="form-submit">Поехали!</button>
            <div class="form-loading">
                <i class="fas fa-spinner"></i>
            </div>
        </form>
    </div>
</div>

<!-- Модальное окно для разработчиков -->
<div id="developerModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3><i class="fas fa-code"></i> Для разработчиков</h3>
            <p>API и инструменты для интеграции с HACCPro</p>
        </div>
        <div class="developer-content">
            <div class="auth-required" id="authRequired">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Требуется авторизация</h4>
                <p>Для доступа к API и документации разработчика необходимо войти в систему</p>
                <button class="auth-button" onclick="openModalWithSource('developer_auth')">
                    <i class="fas fa-sign-in-alt"></i> Войти в систему
                </button>
            </div>
            <div class="developer-tools" id="developerTools" style="display: none;">
                <div class="tools-grid">
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-plug"></i></div>
                        <h4>REST API</h4>
                        <p>Полный набор эндпоинтов для создания и управления документами ХАССП</p>
                        <div class="tool-features">
                            <span class="feature-tag">JSON</span>
                            <span class="feature-tag">OAuth 2.0</span>
                            <span class="feature-tag">Rate limiting</span>
                        </div>
                        <button class="tool-button">Документация API</button>
                    </div>
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-key"></i></div>
                        <h4>API ключи</h4>
                        <p>Управление ключами доступа и мониторинг использования API</p>
                        <div class="tool-features">
                            <span class="feature-tag">Безопасность</span>
                            <span class="feature-tag">Мониторинг</span>
                            <span class="feature-tag">Ротация</span>
                        </div>
                        <button class="tool-button">Управление ключами</button>
                    </div>
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-code-branch"></i></div>
                        <h4>SDK и библиотеки</h4>
                        <p>Готовые SDK для популярных языков программирования</p>
                        <div class="tool-features">
                            <span class="feature-tag">JavaScript</span>
                            <span class="feature-tag">Python</span>
                            <span class="feature-tag">PHP</span>
                        </div>
                        <button class="tool-button">Скачать SDK</button>
                    </div>
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-chart-line"></i></div>
                        <h4>Аналитика</h4>
                        <p>Статистика использования API и производительности интеграций</p>
                        <div class="tool-features">
                            <span class="feature-tag">Метрики</span>
                            <span class="feature-tag">Логи</span>
                            <span class="feature-tag">Алерты</span>
                        </div>
                        <button class="tool-button">Просмотр аналитики</button>
                    </div>
                </div>
                <div class="developer-footer">
                    <div class="support-info">
                        <h5><i class="fas fa-headset"></i> Поддержка разработчиков</h5>
                        <p>Техническая поддержка, обновления API и эксклюзивные возможности</p>
                        <div class="contact-links">
                            <a href="#" class="contact-link">
                                <i class="fab fa-telegram"></i> Telegram канал
                            </a>
                            <a href="#" class="contact-link">
                                <i class="fas fa-envelope"></i> dev@haccpro.ru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "База знаний" -->
<div id="knowledgeBaseModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3><i class="fas fa-book"></i> База знаний</h3>
            <p>Эксклюзивные материалы и руководства по ХАССП</p>
        </div>
        <div class="auth-content">
            <div class="auth-required" id="knowledgeBaseAuth">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Требуется авторизация</h4>
                <p>База знаний доступна только зарегистрированным пользователям</p>
                <button class="auth-button" onclick="openModalWithSource('knowledge_base_auth')">
                    <i class="fas fa-sign-in-alt"></i> Войти в систему
                </button>
            </div>
            <div class="knowledge-content" id="knowledgeContent" style="display: none;">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h4>Руководства по ХАССП</h4>
                        <p>Пошаговые инструкции для разных типов производств</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-file-alt"></i></div>
                        <h4>Шаблоны документов</h4>
                        <p>Готовые шаблоны для быстрого создания документов</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-question-circle"></i></div>
                        <h4>FAQ и ответы</h4>
                        <p>Часто задаваемые вопросы и подробные ответы</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-video"></i></div>
                        <h4>Видеоуроки</h4>
                        <p>Видеоинструкции по работе с системой ХАССП</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "Блог о ХАССП" -->
<div id="blogModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3><i class="fas fa-newspaper"></i> Блог о ХАССП</h3>
            <p>Актуальные новости и статьи о системе ХАССП</p>
        </div>
        <div class="auth-content">
            <div class="auth-required" id="blogAuth">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Требуется авторизация</h4>
                <p>Эксклюзивные статьи блога доступны только подписчикам</p>
                <button class="auth-button" onclick="openModalWithSource('blog_auth')">
                    <i class="fas fa-sign-in-alt"></i> Войти в систему
                </button>
            </div>
            <div class="blog-content" id="blogContent" style="display: none;">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-newspaper"></i></div>
                        <h4>Новости законодательства</h4>
                        <p>Последние изменения в требованиях Роспотребнадзора</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-lightbulb"></i></div>
                        <h4>Советы экспертов</h4>
                        <p>Практические рекомендации от специалистов</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-chart-bar"></i></div>
                        <h4>Аналитика рынка</h4>
                        <p>Тренды и статистика пищевой отрасли</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-comments"></i></div>
                        <h4>Обсуждения</h4>
                        <p>Комментарии и обсуждения с экспертами</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "Истории клиентов" -->
<div id="storiesModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3><i class="fas fa-users"></i> Истории клиентов</h3>
            <p>Реальные кейсы и отзывы наших клиентов</p>
        </div>
        <div class="auth-content">
            <div class="auth-required" id="storiesAuth">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Требуется авторизация</h4>
                <p>Истории успеха клиентов доступны только участникам сообщества</p>
                <button class="auth-button" onclick="openModalWithSource('stories_auth')">
                    <i class="fas fa-sign-in-alt"></i> Войти в систему
                </button>
            </div>
            <div class="stories-content" id="storiesContent" style="display: none;">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-store"></i></div>
                        <h4>Кейсы ресторанов</h4>
                        <p>Как рестораны успешно внедрили ХАССП</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-industry"></i></div>
                        <h4>Промышленные предприятия</h4>
                        <p>Опыт крупных производств</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-coffee"></i></div>
                        <h4>Кафе и кофейни</h4>
                        <p>Истории успеха небольших заведений</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-star"></i></div>
                        <h4>Отзывы клиентов</h4>
                        <p>Реальные отзывы и рекомендации</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "Документация" -->
<div id="documentationModal" class="modal">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">
            <h3><i class="fas fa-file-alt"></i> Документация</h3>
            <p>Подробная документация по работе с системой</p>
        </div>
        <div class="auth-content">
            <div class="auth-required" id="documentationAuth">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Требуется авторизация</h4>
                <p>Полная документация доступна только зарегистрированным пользователям</p>
                <button class="auth-button" onclick="openModalWithSource('documentation_auth')">
                    <i class="fas fa-sign-in-alt"></i> Войти в систему
                </button>
            </div>
            <div class="documentation-content" id="documentationContent" style="display: none;">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-book-open"></i></div>
                        <h4>Руководство пользователя</h4>
                        <p>Подробное руководство по работе с системой</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-cogs"></i></div>
                        <h4>Техническая документация</h4>
                        <p>API, интеграции и технические детали</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-download"></i></div>
                        <h4>Скачиваемые материалы</h4>
                        <p>PDF-руководства, чек-листы, шаблоны</p>
                    </div>
                    <div class="content-card">
                        <div class="content-icon"><i class="fas fa-headset"></i></div>
                        <h4>Поддержка</h4>
                        <p>Как получить помощь и техническую поддержку</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
