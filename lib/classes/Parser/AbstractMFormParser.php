<?php
/**
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 * @package redaxo5
 * @license MIT
 */

abstract class AbstractMFormParser
{
    /**
     * @var array
     */
    protected $elements = array();

    /**
     * @var bool
     */
    protected $fieldset = false;

    /**
     * @var bool
     */
    protected $tab = false;

    /**
     * @var int
     */
    protected $tabGroup = 0;

    /**
     * @var string
     * TODO use it later for custom theme in new MForm()
     */
    protected $theme;

    /**
     * @param MFormElement $element
     * @param string $templateType
     * @param boolean $subPath
     * @return mixed
     * @author Joachim Doerr
     */
    protected function parseElement(MFormElement $element, $templateType, $subPath = false)
    {
        return str_replace(
            array_merge(array(' />'),$element->getKeys()),
            array_merge(array('/>'), $element->getValues()),
            MFormTemplateFileProvider::loadTemplate($templateType, ($subPath) ? MFormTemplateFileProvider::ELEMENTS_PATH : '', $this->theme));
    }

    /**
     * @param array $attributes
     * @return string
     * @author Joachim Doerr
     */
    protected function parseAttributes($attributes)
    {
        $inlineAttributes = '';
        if (sizeof($attributes) > 0) {
            foreach ($attributes as $key => $value) {
                if (!in_array($key, array('id', 'name', 'type', 'value', 'checked', 'selected'))) {
                    $inlineAttributes .= ' ' . $key . '="' . $value . '"';
                }
            }
        }
        return $inlineAttributes;
    }
}
