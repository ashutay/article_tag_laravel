<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ArticleBuilder extends Builder
{
    public function whereActive(): self
    {
        return $this->where('created_at', '<=', now());
    }

    public function whereTags(array $tags): self
    {
        foreach ($tags as $tag) {
            $this->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('name', $tag);
            });
        }

        return $this;

    }
}
