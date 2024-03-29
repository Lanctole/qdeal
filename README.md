## Статусы
Статус является FK для таблицы со статусами:
Созданные статусы: 'Open', 'In Progress', 'Resolved', 'Reopened', 'Closed'

## Список задач
`GET /api/tasks`

Параметры запроса: 

- status (optional): Фильтрует по статусу. `/api/tasks?status=Open` 

- due_date (optional): Фильтрует по совпадению даты. `/api/tasks?due_date_less_than=2024-03-01` 

- due_date_greater_than (optional): Данная дата или позже. `/api/tasks?due_date_greater_than=2024-03-01` 

- due_date_less_than (optional): Данная дата или ранее.  `/api/tasks?due_date_less_than=2024-03-01`


## Создание новой задачи
 `POST /api/tasks`


Параметры запроса:

- `title`: заголовок задачи.
- `description`: описание задачи.
- `status`: статус задачи.
- `due_date`: срок выполнения задачи.


## Получение информации о задаче

`GET /api/tasks/{id}`

Возвращает информацию о конкретной задаче.

## Обновление информации о задаче

`PUT /api/tasks/{id}`

Обновляет информацию о существующей задаче.

Параметры запроса:

- `title` (строка) - новый заголовок задачи.
- `description` (строка) - новое описание задачи.
- `status` (строка) - новый статус задачи.
- `due_date` (дата) - новый срок выполнения задачи.

## Удаление задачи

`DELETE /api/tasks/{id}`

Удаляет задачу по идентификатору.
