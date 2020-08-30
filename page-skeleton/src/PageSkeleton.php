<?php

namespace Brainylab\Laravel\PageSkeleton;

use Brainylab\Laravel\Support\StaticCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class PageSkeleton implements \JsonSerializable, Jsonable, Arrayable
{

    protected $url;

    protected $title;

    protected $description;

    protected $keywords;

    protected $images;

    protected $htmlAttributes;

    protected $bodyAttributes;

    protected $settings;

    protected $styles;

    protected $scripts;

    public static function newCollection(array $items = [])
    {
        return new StaticCollection($items);
    }

    public function __construct
    (
        $url = null,
        $title = null,
        $description = null,
        StaticCollection $keywords = null,
        StaticCollection $images = null,
        StaticCollection $htmlAttributes = null,
        StaticCollection $bodyAttributes = null,
        StaticCollection $settings = null,
        StaticCollection $styles = null,
        StaticCollection $scripts = null
    )
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords ?: self::newCollection();
        $this->images = $images ?: self::newCollection();
        $this->htmlAttributes = $htmlAttributes ?: self::newCollection([
            'prefix' => "og: http://ogp.me/ns#",
            'lang' => 'ru'
        ]);
        $this->bodyAttributes = $bodyAttributes ?: self::newCollection();
        $this->settings = $settings ?: self::newCollection();
        $this->styles = $styles ?: self::newCollection();
        $this->scripts = $scripts ?: self::newCollection();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setKeywords(StaticCollection $collection)
    {
        $this->keywords = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setImages(StaticCollection $collection)
    {
        $this->images = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getHtmlAttributes()
    {
        return $this->htmlAttributes;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setHtmlAttributes(StaticCollection $collection)
    {
        $this->htmlAttributes = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getBodyAttributes()
    {
        return $this->bodyAttributes;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setBodyAttributes(StaticCollection $collection)
    {
        $this->bodyAttributes = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setSettings(StaticCollection $collection)
    {
        $this->settings = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setStyles(StaticCollection $collection)
    {
        $this->styles = $collection;
        return $this;
    }

    /**
     * @return StaticCollection
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param StaticCollection $collection
     * @return $this
     */
    public function setScripts(StaticCollection $collection)
    {
        $this->scripts = $collection;
        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords->toArray(),
            'images' => $this->images->toArray(),
            'htmlAttributes' => $this->htmlAttributes->toArray(),
            'bodyAttributes' => $this->bodyAttributes->toArray(),
            'settings' => $this->settings->toArray(),
            'styles' => $this->styles->toArray(),
            'scripts' => $this->scripts->toArray()
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }


}