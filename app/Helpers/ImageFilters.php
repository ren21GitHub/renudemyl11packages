<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;
class ImageFilters implements ModifierInterface
{
    protected $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $image->pixelate($this->size);
        $image->greyscale();

        return $image;
        // $image->crop(200, 150,45, 9, position: 'bottom-right')
        // ->blur(8);
        return $image;
    }
}