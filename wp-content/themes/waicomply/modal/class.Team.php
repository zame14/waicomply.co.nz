<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/24/2021
 * Time: 3:58 PM
 */
class Team extends waiBase
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post->ID, 'full');
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function getExpertise()
    {
        global $wpdb;
        $sql = '
        SELECT tt.term_id
        FROM ' . $wpdb->prefix . 'term_relationships tr
        INNER JOIN ' . $wpdb->prefix . 'term_taxonomy tt
        ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN ' . $wpdb->prefix . 'terms t
        ON tt.term_id = t.term_id
        WHERE object_id = ' . $this->id() . '
        ORDER BY t.term_order ASC';
        $results = $wpdb->get_results($sql);
        $html = '<ul class="plain">';
        foreach($results as $result)
        {
            $category = new Term($result->term_id);
            $html .= '<li>' . $category->Term->name . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}