<?php

namespace KKPhim\Core\Traits;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Str;

trait HasDescription
{
    protected function descriptionPattern(): string
    {
        return Setting::get('site.title');
    }

    public function getDescription(): string
    {
        $pattern = $this->descriptionPattern();

        preg_match_all('/{.*?}/', $pattern, $vars);

        foreach ($vars[0] as $var) {
            try {
                $x = str_replace('{', '', $var);
                $x = str_replace('}', '', $x);
                $keys = explode('.', (string) $x);
                $data = $this;
                foreach ($keys as $key) {
                    $data = $data->{$key};
                }
                $pattern = str_replace($var, $data, $pattern);
            } catch (\Exception $e) {
            }
        }

        return $pattern;
    }
}
