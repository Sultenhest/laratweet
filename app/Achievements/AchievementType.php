<?php

namespace App\Achievements;

use App\Achievement;
use Illuminate\Support\Str;

abstract class AchievementType
{
    protected $model;

    public function __construct()
    {
        $this->model = Achievement::firstOrCreate([
            'name' => $this->name(),
            'description' => $this->description,
            'icon' => $this->icon
        ]);
    }

    public function name()
    {
        if (property_exists($this, 'name'))
        {
            return $this->name;
        }

        return Str::title(Str::snake(class_basename($this), ' '));
    }

    abstract public function qualifier($user);

    public function modelKey()
    {
        return $this->model->getKey();
    }
}