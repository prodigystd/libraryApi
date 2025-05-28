<?php

namespace LibraryApi\Resources;

class AuthorsByBook extends JsonResource
{

    public function serialize(): array
    {
        $formattedData = [];
        foreach ($this->data as $row) {
            if (!isset($formattedData[$row['id']])) {
                $formattedData[$row['id']]['id'] = $row['id'];
                $formattedData[$row['id']]['fullname'] = $row['fullname'];
                $formattedData[$row['id']]['birth_date'] = $row['birth_date'];
                $formattedData[$row['id']]['description'] = $row['description'];
            }

            $book = [];
            $book['id'] = $row['book_id'];
            $book['name'] = $row['book_name'];
            $book['description'] = $row['book_description'];
            $book['year'] = $row['book_year'];
            $book['genre'] = $row['book_genre'];

            $formattedData[$row['id']]['books'][] = $book;
        }
        return ['data' => array_values($formattedData)];
    }

}