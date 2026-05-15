<?php

declare(strict_types=1);

enum TaskStatus: string
{
    case Pending = 'pendin';
    case InProgress = 'in_progress';
    case Done = 'Done';
}
