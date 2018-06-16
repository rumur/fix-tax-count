<?php

namespace Rumur\App;

/**
 * Class FixTaxCount
 * @author rumur
 */
class FixTaxCount {
    /** @var string */
    protected $post_type;
    /** @var array */
    protected $taxonomies;
    /** @var string|array */
    protected $specific_tax;
    /** @var array */
    protected $available_tax;
    /** @var array  */
    protected $excluded_tax = [
        'nav_menu',
        'post_format',
        'link_category',
    ];

    /**
     * FixTaxCount constructor.
     * @param null|string   $post_type
     * @param string|array  $specific_tax
     */
    public function __construct($post_type = null, $specific_tax = [])
    {
        $this->available_tax = get_taxonomies();

        $this->setPostType($post_type);
        $this->setTaxonomy((array) $specific_tax);
    }

    /**
     * Factory
     *
     * @return FixTaxCount
     *
     * @author rumur
     */
    public static function make()
    {
        $self = new self(...func_get_args());

        return $self;
    }

    /**
     * @param $post_type
     * @return $this
     *
     * @author rumur
     */
    public function setPostType($post_type)
    {
        if (post_type_exists($post_type)) {
            $this->post_type = sanitize_text_field($post_type);
        }

        return $this;
    }

    /**
     * @param array $taxonomy
     * @return $this
     *
     * @author rumur
     */
    public function setTaxonomy(array $taxonomy)
    {
        // Remove not registered taxonomies
        $tax = array_intersect($taxonomy, $this->available_tax);

        // Excluded taxonomies are not allowed to process.
        $this->taxonomies = array_diff($tax, $this->excluded_tax);

        return $this;
    }

    /**
     * @param string| array $tax
     *
     * @return $this
     *
     * @author rumur
     */
    public function excludeTaxonomy($tax)
    {
        $tax = (array) $tax;

        array_push($this->excluded_tax, ...$tax);

        $this->excluded_tax = array_unique($this->excluded_tax);

        return $this;
    }

    /**
     * @return bool
     *
     * @author rumur
     */
    public function process()
    {
        return $this->fixTaxonomyCount();
    }

    /**
     * @return array
     *
     * @author rumur
     */
    protected function getPostTypeTaxonomies()
    {
        return get_object_taxonomies($this->post_type);
    }

    /**
     * @param array $taxonomy
     * @return array
     *
     * @author rumur
     */
    protected function verifyPostTypeTaxonomies(array $taxonomy)
    {
        return ! $this->post_type
            ? $taxonomy
            : array_intersect($this->getPostTypeTaxonomies(), $taxonomy);
    }

    /**
     * @return bool
     *
     * @author rumur
     */
    protected function fixTaxonomyCount()
    {
        $result = array_map(function ($tax) {

            $update_terms = get_terms([
                'fields' => 'ids',
                'taxonomy' => $tax,
                'hide_empty' => false,
            ]);

            return is_wp_error($update_terms)
                ? false
                : wp_update_term_count_now($update_terms, $tax);
        }, $this->verifyPostTypeTaxonomies($this->taxonomies));

        return !empty(array_filter($result));
    }
}