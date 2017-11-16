<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{

    /**
     * Gets a given property from the repository
     *
     * @param $property
     * @return mixed
     * @throws \Exception
     */
    public function getProperty($property)
    {
       if (!$this->$property) {
            throw new \Exception('Argument "property" is invalid for getProperty($property)');
        }

        return $this->$property;
    }

}