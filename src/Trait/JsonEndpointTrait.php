<?php
declare(strict_types = 1);

namespace App\Trait;

trait JsonEndpointTrait 
{

    protected function cje(bool $status, string|int $message, string|int $message_name = 'message'): array {
        return array(
            'status' => $status, 
            $message_name => $message,
        );;
    }
    
}