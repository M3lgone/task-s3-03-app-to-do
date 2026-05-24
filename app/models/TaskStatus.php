<?php

declare(strict_types=1);

enum TaskStatus: string
{
    case PENDING = 'Pending';
    case IN_PROGRESS = 'In progress';
    case DONE = 'Done';

    public function getButtonClass(): string
    {
        return match($this) {
            TaskStatus::PENDING     => 'border-sky-700',
            TaskStatus::IN_PROGRESS => 'border-sky-400 bg-sky-200',
            TaskStatus::DONE        => 'border-sky-700 bg-sky-500',
        };
    }
}
