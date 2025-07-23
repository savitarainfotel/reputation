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

    public function resolveRouteBinding($hashed, $field = null)
    {
        $id = $this->getDecodedId($hashed);

        if (empty($id)) {
            abort(404);
        }

        return $this->where($field ?? $this->getRouteKeyName(), $id)->firstOrFail();
    }

    /**
     * Decode a given hashed ID and return the original ID.
     *
     * @param string $hashed
     * @return int|null
     */
    public static function getDecodedId(string $hashed): ?int
    {
        $decoded = Hashids::decode(str_replace('-', '', $hashed));
        return $decoded[0] ?? null;
    }

    /**
     * Accessor for `$model->enc_id`
     *
     * @return string
     */
    public function getEncIdAttribute(): string
    {
        return $this->getRouteKey();
    }

    /**
     * Accessor for `$model->dec_id` (not often used, but here if needed)
     *
     * @return int
     */
    public function getDecIdAttribute(): int
    {
        return $this->getKey();
    }
}