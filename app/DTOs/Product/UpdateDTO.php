<?php

namespace App\DTOs\Product;

class UpdateDTO
{
    public function __construct(
        public string  $name,
        public string  $slug,
        public ?string $description,
        public int     $price,
        public int     $stock,
    )
    {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['slug'],
            $data['description'] ?? null,
            $data['price'],
            $data['stock'],
        );
    }
}
