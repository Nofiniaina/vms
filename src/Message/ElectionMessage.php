<?php

namespace App\Message;

use App\Entity\Vote;

final class ElectionMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

    public function __construct(
        public readonly string $title,
        public readonly int $vote
    ) {
    }
}
