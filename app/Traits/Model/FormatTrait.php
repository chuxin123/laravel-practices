<?php

namespace App\Traits\Model;

use Illuminate\Support\Str;

trait FormatTrait
{
    /**
     * Get an attribute from the model.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->relations)) {
            return parent::getAttribute($key);
        } elseif ($res = parent::getAttribute($key)) {
            return $res;
        } else {
            return parent::getAttribute(Str::snake($key));
        }
    }

    /**
     * Override toArray method
     * @return array
     */
    public function toArray()
    {
        $raw = parent::toArray();
        $convert = $this->underscoreToHump($raw);
        return $convert;
    }

    /**
     * underscore to hump
     * @param $data
     *
     * @return array
     */
    private function underscoreToHump($data): array
    {
        $newParameters = [];
        if ($data) {
            foreach ($data as $key => $value) {
                if (!is_int($key)) {
                    if (is_array($value)) {
                        $newParameters[Str::camel($key)] = $this->underscoreToHump($value);
                    } else {
                        $newParameters[Str::camel($key)] = $value;
                    }
                } else if (is_array($value)) {
                    $newParameters[$key] = $this->underscoreToHump($value);
                } else {
                    $newParameters[$key] = $value;
                }
            }
        }
        return $newParameters;
    }
}
