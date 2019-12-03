<?php
declare(strict_types=1);

namespace Procurios\Meeting\Tests;

use DateTimeImmutable;
use InvalidArgumentException;
use Procurios\Meeting\Meeting;
use Procurios\Meeting\Program;
use Procurios\Meeting\ProgramSlot;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class MeetingTest extends TestCase
{
    public function testThatValidMeetingsCanBeInstantiated()
    {
        $this->assertInstanceOf(
            Meeting::class,
            new Meeting(
                Uuid::uuid4(),
                'TDD, DDD & Teamwork',
                'This is a silly workshop, don\'t come',
                new DateTimeImmutable('2020-01-01 19:00'),
                new DateTimeImmutable('2020-01-01 21:00'),
                new Program([
                    new ProgramSlot(
                        new DateTimeImmutable('2020-01-01 19:00'),
                        new DateTimeImmutable('2020-01-01 20:00'),
                        'Divergence',
                        'Main room'
                    ),
                    new ProgramSlot(
                        new DateTimeImmutable('2020-01-01 20:00'),
                        new DateTimeImmutable('2020-01-01 21:00'),
                        'Convergence',
                        'Main room'
                    ),
                ])
            )
        );
    }

    public function testThatProgramOnlyAcceptsProgramSlots()
    {
        $this->expectException(InvalidArgumentException::class);
        new Program([new DateTimeImmutable('2020-01-01 19:00')]);
    }
}
