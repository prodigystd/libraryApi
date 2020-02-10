# libraryApi




Использование:
В корневой папке запустить:
docker-compose up

Описание api:

выдача всех книг одного автора:
Тип запроса: GET 
Параметр: author_name
Тип параметра: строка
http://localhost:8080/book/books-by-author?author_name=Толстой

выдача автора по книге:
Тип запроса: GET 
Параметр: book_name
Тип параметра: строка
http://localhost:8080/author/authors-by-book?book_name=Война


выдача списка книг, написанных ровно 3 соавторами. Результат: книга - количество соавторов.
Тип запроса: GET 
Параметр: author_count
Тип параметра: целое число
http://localhost:8080/book/books-by-author-count?author_count=3

