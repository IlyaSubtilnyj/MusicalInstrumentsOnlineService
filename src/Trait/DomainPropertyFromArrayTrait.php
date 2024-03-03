<?php

namespace App\Trait;

trait DomainPropertyFromArrayTrait 
{

    public function setPropertiesFromArray($data) {
        foreach ($data as $key => $value) {
            $setterMethod = 'set' . ucfirst($key);
            if (method_exists($this, $setterMethod)) {
                $this->$setterMethod($value);
            } else {
                throw new Exception("Setter method $setterMethod does not exist.");
            }
        }
        return $this;
    }
    
}