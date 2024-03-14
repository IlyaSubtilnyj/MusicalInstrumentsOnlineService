<?php

namespace App\DTO;

use App\Entity\Category;


class CategoryDTO {

    private Category $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function serialize(): array
    {
        return [
          'id' => $this->category->getId(),
          'name' => $this->category->getName(),
          'description' => $this->category->getDescription(),
        ];
    }

}