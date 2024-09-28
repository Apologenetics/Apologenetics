<?php

namespace App\Contracts\Doctrine;

use App\Models\Doctrine;

interface CreatesDoctrine
{
    /**
     * Creates a doctrine object along with doctrinable
     *
     * @param  array  $data
     * @return void
     */
    public function __invoke(array $data): Doctrine;
}
