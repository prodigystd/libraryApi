<?php

namespace LibraryApi\Resources;

class BooksByAuthor extends JsonResource
{

    public function serialize(): array
    {
        $formattedData = [];
        foreach ($this->data as $row) {
            if (!isset($formattedData[$row['id']])) {
                $formattedData[$row['id']]['id'] = $row['id'];
                $formattedData[$row['id']]['name'] = $row['name'];
                $formattedData[$row['id']]['description'] = $row['description'];
                $formattedData[$row['id']]['year'] = $row['year'];
                $formattedData[$row['id']]['genre'] = $row['genre'];
            }

            $author = [];
            $author['id'] = $row['author_id'];
            $author['fullname'] = $row['author_fullname'];
            $author['birth_date'] = $row['author_birth_date'];
            $author['description'] = $row['author_description'];

            $formattedData[$row['id']]['author'] = $author;
        }
        return ['data' => array_values($formattedData)];
    }

}