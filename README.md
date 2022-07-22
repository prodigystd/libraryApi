# Description

Design a database schema and a backend for storing a library. It should store authors and their books. User interaction occurs through HTTP requests to the API. All responses are JSON objects.

The server implements the following methods:

Selecting all books by one author<br />
Getting the author on the book<br />
Getting a list of books written by exactly 2 co-authors. Result: book - number of co-authors.<br />
Requirements:<br />

Code according to PSR standards and
it is forbidden to use any frameworks or program libraries



# Usage:
In the project root folder run:<br />

Installation:<br />
make local-start<br />

Run tests:<br />
make local-test<br />

# The project architecture:
The project implements microkernel architecture(microkernel + plugins)
and MVC pattern(Layered architecture). Plugins are named as modules in this microkernel architecture 
implementation.

# API description:

Listing all books by the same author:<br />
Request type: GET <br />
Parameter: author_name<br />
Parameter type: string<br />
http://localhost:8080/books?author_name=Joanne

Getting the author by the book:<br />
Request type: GET <br />
Parameter: book_name<br />
Parameter type: string<br />
http://localhost:8080/authors?book_name=Harry<br />


Getting a list of books written by exactly 2 co-authors. Result: book - number of coauthors:<br />
Request type: GET <br />
Parameter: author_count<br />
Parameter type: integer<br />
http://localhost:8080/books?author_count=2<br />




# Описание

Спроектировать схему БД и backend для хранения библиотеки. Интересуют авторы и книги. Взаимодействие с пользователем происходит посредством HTTP запросов к API. Все ответы представляют собой JSON объекты.

Сервер реализует следующие методы:

выдача всех книг одного автора<br />
выдача автора по книге<br />
выдача списка книг, написанных ровно 2 соавторами. Результат: книга - количество соавторов.<br />
Требования:<br />

оформить код по стандартам PSR и
запрещается использовать различные framework’и


# Использование:
В корневой папке проекта запустить:<br />

Установка:<br />
make local-start<br />

Запуск тестов:<br />
make local-test<br />

# Архитектура проекта:
Проект реализует микроядерную архитектуру (микроядро + плагины)
и MVC паттерн (Многоуровневая архитектура). Плагины названы модулями(Modules) в данной реализации микроядерной
архитектуры.

# Описание API:

выдача всех книг одного автора:<br />
Тип запроса: GET <br />
Параметр: author_name<br />
Тип параметра: строка<br />
http://localhost:8080/books?author_name=Joanne

выдача автора по книге:<br />
Тип запроса: GET <br />
Параметр: book_name<br />
Тип параметра: строка<br />
http://localhost:8080/authors?book_name=Harry<br />


выдача списка книг, написанных ровно 2 соавторами. Результат: книга - количество соавторов:<br />
Тип запроса: GET <br />
Параметр: author_count<br />
Тип параметра: целое число<br />
http://localhost:8080/books?author_count=2<br />

