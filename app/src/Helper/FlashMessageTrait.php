<?php

namespace App\Helper;

trait FlashMessageTrait
{

    public function messageDefinition(string $type, string $message): void
    {
        $_SESSION['message_content'] = $message;
        $_SESSION['message_type'] = $type;
    }

}