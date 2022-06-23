# libraryApi

Design a database schema and a backend for storing a library. It should store authors and their books. User interaction occurs through HTTP requests to the API. All responses are JSON objects.

The server implements the following methods:

selecting all books by one author
getting the author on the book
getting a list of books written by exactly 2 co-authors. Result: book - number of co-authors.
Requirements:

code according to PSR standards and
it is forbidden to use different frameworks


# Usage:
In the root folder run:
docker-compose-up

# API description:

listing all books by the same author:<br />
Request type: GET <br />
Parameter: author_name<br />
Parameter type: string<br />
http://localhost:8080/book/books-by-author?author_name=Antoine

getting the author by the book:<br />
Request type: GET <br />
Parameter: book_name<br />
Parameter type: string<br />
http://localhost:8080/author/authors-by-book?book_name=Harry<br />


getting a list of books written by exactly 2 co-authors. Result: book - number of coauthors:<br />
Request type: GET <br />
Parameter: author_count<br />
Parameter type: integer<br />
http://localhost:8080/book/books-by-author-count?author_count=2<br />

#

Спроектировать схему БД и backend для хранения библиотеки. Интересуют авторы и книги. Взаимодействие с пользователем происходит посредством HTTP запросов к API. Все ответы представляют собой JSON объекты.

Сервер реализует следующие методы:

выдача всех книг одного автора
выдача автора по книге
выдача списка книг, написанных ровно 3 соавторами. Результат: книга - количество соавторов.
Требования:

оформить код по стандартам PSR и
запрещается использовать различные framework’и


# Использование:
В корневой папке запустить:
docker-compose up

# Описание api:

выдача всех книг одного автора:<br />
Тип запроса: GET <br />
Параметр: author_name<br />
Тип параметра: строка<br />
http://localhost:8080/book/books-by-author?author_name=Antoine

выдача автора по книге:<br />
Тип запроса: GET <br />
Параметр: book_name<br />
Тип параметра: строка<br />
http://localhost:8080/author/authors-by-book?book_name=Harry<br />


выдача списка книг, написанных ровно 2 соавторами. Результат: книга - количество соавторов:<br />
Тип запроса: GET <br />
Параметр: author_count<br />
Тип параметра: целое число<br />
http://localhost:8080/book/books-by-author-count?author_count=2<br />

