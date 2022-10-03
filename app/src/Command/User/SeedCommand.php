<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Database\User;
use Faker\Factory;
use Spiral\Console\Command;
use Spiral\Prototype\Traits\PrototypeTrait;

class SeedCommand extends Command
{
    use PrototypeTrait;

    protected const NAME        = 'user:seed';
    protected const DESCRIPTION = 'Seed application users';

    protected function perform(): int
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->firstName = $faker->firstName();
            $user->lastName = $faker->lastName();
            $user->email = $faker->email();
            $user->passwordHash = $this->passwords->hash($faker->password());
            $user->roles = 'user';

            $this->entities->save($user);
        }

        $this->output->success('Database seeding completed successfully.');

        return self::SUCCESS;
    }
}
