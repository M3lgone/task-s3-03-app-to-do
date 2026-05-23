<?php

declare(strict_types=1);

enum TaskStatus: string
{
    case PENDING = 'Pending';
    case IN_PROGRESS = 'In progress';
    case DONE = 'Done';
}
