<?php
namespace Craft;

class EmbedlyVariable
{
    public function oembed($url)
    {
        return craft()->embedly->oembed($url);
    }
}