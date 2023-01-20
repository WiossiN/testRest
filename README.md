<p align="center">
    <h1 align="center">Super Parcer</h1>
    <br>
</p>

## Тестовое задание

Данное приложение позволяет сделать спарсить информацию используюя кадастровые номера.
Основные способы работы с приложением.

* Получение списка в WEB
* Выдача JSON через REST
* Консольное взаимодействие
### РАбота через WEB

Для работы через WEB реализована страница с полем ввода кадастровых номеров.

Url: `/site/index`

![пример](dockimg/img1.JPG)

При вводе кадастровых номеров через запятую вы получите их список. Если информация во внутренней базе данных будет устаревшая или неполная, выполниться парсинг недостающих данных

### РАбота через консоль

Для работы через консоль реализован метод, которому на ввод даётся перечисление кадастровых номеров, через зяпятую.

#### Команда

`php yii parcer/parce [КАДАСТРОВЫЕ НОМЕРА]`

#### Результат

| id | CN | Address | Price | Area | Created | Updated |
|---|---|---|---|---|---|---|
| 1 | 69:27:0000022:1306 | Тверская область, р-н Ржевский, с/пос "Успенское", северо-западнее д. Горшково из земель СПКколхоз "Мирный" | 36126 | 10035 | 1674206515 | 167421021 |


### РАбота через REST 

Для работы через консоль реализован метод, которому на ввод даётся перечисление кадастровых номеров, через зяпятую.

Url: `/rest`

#### Возвращает

|  Параметр | Тип  | Значение  |
|---|---|---|
|result| json | информация из базы данных |

**Ответ:**

```json
[
  {
    "id": 1,
    "cadastraNumber": "69:27:0000022:1306",
    "address": "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
    "price": 36126,
    "area": 10035,
    "created_at": 1674206515,
    "updated_at": 1674206515
  },
  {
    "id": 2,
    "cadastraNumber": "69:27:0000022:1307",
    "address": "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
    "price": 36633.6,
    "area": 10176,
    "created_at": 1674208400,
    "updated_at": 1674208400
  }
]
```

Структура директорий приложения
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```