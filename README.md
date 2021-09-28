[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Zebrainsteam/laravel-generator-package/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

# Laravel generator package - Генератор пакетов для Laravel

<p><strong>Главная задача пакета, автоматизировать генерацию кода для решения бизнес задач при разработке на фреймворке Laravel:</strong></p>
<ul>
<li>Миграции</li>
<li>(Опционально) Сиды (+factories)</li>
<li>Модель</li>
<li>CRUD интерфейс (без view для возможно переиспользовать в своих сценариях)</li>
<li>(Опционально) Интерфейс для Laravel Admin + route</li>
<li>(Опционально) Базовое API для работы с данными + route</li>
<li>(Опционально) API для передачи архитектуры формы и фильтров для автоматизации frontend + route</li>
<li>(Опционально) Базовые тесты</li>
</ul>

<p><strong>В отличии от других генераторов для Laravel, данный пакет:</strong></p> 
<ul>
<li>Упаковывает код в отдельный composer package.</li>
<li>Возможность реализовать кастомные поля.</li>
</ul>

### План работы
<ol>
<li>Устанавливаем пакет Zebrainsteam/laravel-generator-package</li>
<li>Настраиваем конфигурационный файл пакета, указав структуру и данные планируемых пакетов.</li>
<li>Запускаем генератор и на выходе получаем сгенерированные пакеты в отдельных категориях готовые для публикации и последующего использования.</li>
</ol>

## Install - Установка

<pre>composer require Zebrainsteam/laravel-generator-package</pre>

## Конфигурационный файл

<pre>php artisan vendor:publish --force --provider="Zebrainsteam\LaravelGeneratorPackage\ServiceProvider" --tag="config"</pre>

## Добавление ServiceProvider в config/app.php секция 'providers'

<pre>Zebrainsteam\LaravelGeneratorPackage\ServiceProvider::class,</pre>

## Добавление миграций для словарей

<pre>php artisan migrate</pre>

## Добавление стандартных словарей

<pre>php artisan db:seed --class="Zebrainsteam\LaravelGeneratorPackage\DataBase\Seeders\DatabaseSeeder"</pre>

## Сборка пакетов из конфига

<strong>Все пакеты</strong>
<pre>php artisan lgp:make</pre>

<strong>Пакеты с конкретными vendor</strong>
<pre>php artisan lgp:make vendor_name</pre>

<strong>Конкретный пакет</strong>
<pre>php artisan lgp:make vendor_name/package_name</pre>

## Настройка конфигурационного файла

<strong>fields</strong> - директива принимает массив классов, доступных в пакете полей (Fields). Заменяет стандартный набор.
<p>Реализовать свое поле можно реализуя интерфейс FieldInterface или наследуя абстрактный класс FieldAbstract. </p>
Пример:
<pre>
    'fields' => [
        'text' => TextField::class,
        'string' => StringField::class,
        'integer' => IntegerField::class,
        'float' => FloatField::class,
    ],
</pre>

<strong>generator</strong> - многомерный массив, элемент массива - настройки отдельного пакета для генерации.
<p><strong>name</strong> - имя генерируемого пакета</p>
<p><strong>description</strong> - описание генерируемого пакета</p>
<p><strong>vendor</strong> - vendor генерируемого пакета (аккаунт в GIT)</p>
<p><strong>package</strong> - имя package генерируемого пакета (репозиторий аккаунта в GIT)</p>
<p><strong>model</strong> - имя модели в генерируем пакете</p>
<p><strong>table</strong> - название таблицы в БД к которой будет привязана модель в генерируем пакете</p>
<p><strong>generator</strong> - позволяет отключить генерацию тестов (tests), сидов и фабрик (seed), api общего (api), api lля предоставления информации для автоматизации frontend (api_frontend) и компонентов необходимых для работы пакета в Laravel Admin (laravel_admin)</p>
<p><strong>form</strong> - cхема генерации формы для добавления/редактирования записей. Конечный элемент название поля. </p>
<p><strong>filter</strong> - cхема генерации формы фильтров. Конечный элемент название поля. </p>
<p><strong>fields</strong> - многомерный массив. Ключ - это имя поля в БД. Особенности настройки полей смотрите ниже.</p>

Пример:
<pre>
    'generator' => [
        [
            'name' => 'Name package',
            'description' => 'Description package',
            'vendor' => 'Zebrainsteam',
            'package' => 'test',
            'model' => 'test',
            'table' => 'test',
            'generator' => [
                'tests' => true,
                'seed' => true,
                'api' => true,
                'api_frontend' => true,
                'laravel_admin' => true,
            ],
            'fields' => [
                'title' => [
                    НАСТРОЙКИ ПОЛЯ title
                ]
            ],
            'form' => [
                [
                    'title',
                ],
            ],
            'filter' => [
                [
                    'title',
                ],
            ]
        ]
    ]
</pre>

### Заполнение настроек отдельного поля

<p><strong>name_field_in_db</strong> - уникальное название в таблице базы данных</p>
<p><strong>field</strong> - ключ используемого доступного поля из директивы 'fields'.</p>
<p><strong>label</strong> - используемое имя / заголовок поля.</p>
<p><strong>placeholder</strong> - placeholder для использования в html.</p>
<p><strong>default</strong> - значение по умолчанию для поля.</p>
<p><strong>index</strong> - Если установить true, то для столбца будет создан индекс.</p>
<p><strong>fillable</strong> - добавляет поле в массив fillable создаваемой модели.</p>
<p><strong>hidden</strong> - добавляет поле в массив hidden создаваемой модели для скрытия.</p>
<p><strong>references</strong> - принимает 4 параметра для создания связи модели с моделью для другой таблицы. has - тип связи, model - путь с именем модели с которой будет создана связь, table - имя таблицы с которой будет создана связь, field - имя поля с которым будет создана связь.</p>
<p><strong>param</strong> - по необязательное поле умолчанию null. Используется для передачи параметров для генерации некоторых field (например массив словарей для select форм или идентификатор словаря из БД).</p>
<p><strong>filter</strong> - принимает параметры помогающие фильтровать и создавать проверку при работе модели:</p>
<p><b>filter['nullable']</b> - возможность записать в ячейку значение NULL</p>
<p><b>filter['unique']</b> - поле принимает только уникальное значение</p>
<p><b>filter['required']</b> - поле обязательное для заполнения</p>
<p><b>filter['max']</b> - максимальная длина значения для записи в БД</p>
<p><b>filter['min']</b> - минимальная длина значения для записи в БД</p>
<p><b>filter['mask']</b> - маска для проверки соответствия значения желаемому значению.</p>

<pre>
'name_field_in_db' => [
    'field' => 'text',
    'label' => 'Title',
    'placeholder' => 'Enter label',
    'default' => null,
    'index' => false,
    'fillable' => true,
    'hidden' => false,
    'references' => [
        'model' => 'App\Models\User',
        'table' => 'user',
        'field' => 'id',
        'has' => 'hasOne',
    ],
    'param' => false,
    'filter' => [
        'nullable' => true,
        'unique' => false,
        'required' => false,
        'max' => null,
        'min' => null,
        'mask' => null,
    ]
]
</pre>

