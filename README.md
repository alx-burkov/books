### Описание компонента

Простой компонент для работы с данными (CRUD).  
Клиент использует библиотеку JQuery.  
База данных - postgreSQL

При сохранении данных (добавление новой записи и редактирование) отправляется соответствующее сообщение на почту с данными.

#### Описание запросов

1. CRUD запросы:

``/books``

2. API запрос на получение списка всех книг в JSON формате:

``/api/books``

#### Описание таблицы

```sql
CREATE TABLE books (
    id SERIAL PRIMARY KEY,
    author VARCHAR(200) NOT NULL,
    title VARCHAR(50) NOT NULL,
    short_descr VARCHAR(500) NOT NULL
);
```
