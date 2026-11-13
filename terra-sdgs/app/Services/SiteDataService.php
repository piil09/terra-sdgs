<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Schema;

class SiteDataService
{
    protected ?array $tokens = null;
    protected ?array $content = null;
    protected ?array $assets = null;

    public function tokens(): array
    {
        if ($this->tokens === null) {
            $path = resource_path('data/tokens.json');
            $this->tokens = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
        }
        return $this->tokens;
    }

    public function content(): array
    {
        if ($this->content === null) {
            $path = resource_path('data/content.json');
            $this->content = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
        }
        return $this->content;
    }

    public function assets(): array
    {
        if ($this->assets === null) {
            $path = resource_path('data/assets.json');
            $this->assets = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
        }
        return $this->assets;
    }

    public function site(): array
    {
        return $this->content()['site'] ?? [];
    }

    public function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->content();
        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }
        return $value;
    }

    public function events(): array
    {
        try {
            if (Schema::hasTable('events')) {
                $dbEvents = Event::latest()->get()->toArray();
                if (!empty($dbEvents)) {
                    return $dbEvents;
                }
            }
        } catch (\Throwable $e) {
        }
        return $this->content()['events'] ?? [];
    }

    public function event(int $id): ?array
    {
        try {
            if (Schema::hasTable('events')) {
                $ev = Event::find($id);
                if ($ev) {
                    return $ev->toArray();
                }
            }
        } catch (\Throwable $e) {
        }
        foreach ($this->events() as $event) {
            if ($event['id'] == $id) {
                return $event;
            }
        }
        return null;
    }

    public function articles(): array
    {
        return $this->content()['articles'] ?? [];
    }

    public function article(string $slug): ?array
    {
        foreach ($this->articles() as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        return null;
    }
}
