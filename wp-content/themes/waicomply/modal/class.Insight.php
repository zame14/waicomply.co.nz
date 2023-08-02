<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/28/2021
 * Time: 9:35 AM
 */
class Insight extends waiBase
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post->ID, 'full');
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
}