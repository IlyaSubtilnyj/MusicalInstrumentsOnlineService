<?php

namespace App\DTO;

use App\Entity\Instrument;


class InstrumentDTO {

    private Instrument $instrument;

    public function __construct(Instrument $instrument) {
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