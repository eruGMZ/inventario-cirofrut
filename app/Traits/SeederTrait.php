<?php

namespace App\Traits;

use Closure;

trait SeederTrait
{
    /**
     * Creates data in the database if it doesn't already exist.
     *
     * @param array $data
     * @param string $model
     * @param \Closure|null $function
     * @return bool
     */
    public function createData(array $data, string $model, ?Closure $function = null): bool
    {
        try {
            foreach ($data as $value) {
                $builder = $function($model::query(), $value);

                if ($builder->get()->count() > 0) continue;

                $builder->create($value);
            }

            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
