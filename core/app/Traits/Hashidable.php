<?php

namespace App\Traits;

use Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        $raw = Hashids::encode($this->getKey());
        return substr($raw, 0, 8) . '-' . substr($raw, 8, 4) . '-' . substr($raw, 12, 4) . '-' . substr($raw, 16, 4) . '-' . substr($raw, 20);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $id = Hashids::decode(str_replace('-', '', $value));

        if (empty($id)) {
            abort(404);
        }

        return $this->where($field ?? $this->getRouteKeyName(), $id[0])->firstOrFail();
    }
}