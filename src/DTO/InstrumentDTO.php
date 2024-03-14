<?php

namespace App\DTO;

use App\Entity\Model;


class InstrumentDTO {

    private Model $instrument;

    public function __construct(Model $instrument) {
        $this->instrument = $instrument;
    }

    public function serialize(): array
    {
        return [
          'id' => $this->instrument->getId(),
          'name' => $this->instrument->getName(),
          'description' => $this->instrument->getDescription(),
        ];
    }

}