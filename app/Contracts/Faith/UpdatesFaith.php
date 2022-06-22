<?php

namespace App\Contracts\Faith;

use App\Models\Faith;

interface UpdatesFaith
{
    /**
     * Updates a current faith instance
     *
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws App\Exceptions\Faith\InvalidFaithUpdateDataException;
     * @throws App\Excpetions\Faith\MismatchFaithUserException
     * @param array $data
     * @param Faith|null $faith
     * @param int|null $faith_id
     * @return void
     */
    public function __invoke(array $data, bool $hasDenomination, ?Faith $faith = null, ?int $faith_id = null): void;
}
