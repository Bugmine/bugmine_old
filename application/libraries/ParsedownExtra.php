<?php

/*
 * The MIT License
 *
 * Copyright 2014 Stefan Schmid <stefanschmid35@googlemail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of ParsedownExtensions
 *
 * @author Stefan Schmid <stefanschmid35@googlemail.com>
 */
class ParsedownExtra extends Parsedown
{
    #
    # ~

    private $footnoteCount = 0;

    #
    # ~
    private $attributesPattern = '{((?:[#.][-\w]+[ ]*)+)}';

    #
    # Blocks
    #
    #
    # Atx

    function __construct()
    {
        $this->BlockTypes[':'] [] = 'DefinitionList';
        $this->DefinitionTypes['*'] [] = 'Abbreviation';
        # identify footnote definitions before reference definitions
        array_unshift($this->DefinitionTypes['['], 'Footnote');
        # identify footnote markers before before links
        array_unshift($this->SpanTypes['['], 'FootnoteMarker');
    }

    #
    # Definition List

    protected function identifyAtx($Line)
    {
        $Block = parent::identifyAtx($Line);
        if (preg_match('/[ #]*' . $this->attributesPattern . '[ ]*$/', $Block['element']['text'], $matches, PREG_OFFSET_CAPTURE)) {
            $attributeString = $matches[1][0];
            $Block['element']['attributes'] = $this->parseAttributes($attributeString);
            $Block['element']['text'] = substr($Block['element']['text'], 0, $matches[0][1]);
        }
        return $Block;
    }

    private function parseAttributes($attributeString)
    {
        $Data = array();
        $attributes = preg_split('/[ ]+/', $attributeString, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($attributes as $attribute) {
            if ($attribute[0] === '#') {
                $Data['id'] = substr($attribute, 1);
            } else { # "."
                $classes [] = substr($attribute, 1);
            }
        }
        if (isset($classes)) {
            $Data['class'] = implode(' ', $classes);
        }
        return $Data;
    }

    #
    # Setext

    protected function identifyDefinitionList($Line, $Block)
    {
        if (isset($Block['type'])) {
            return;
        }
        $Element = array(
            'name' => 'dl',
            'handler' => 'elements',
            'text' => array(),
        );
        $terms = explode("\n", $Block['element']['text']);
        foreach ($terms as $term) {
            $Element['text'] [] = array(
                'name' => 'dt',
                'handler' => 'line',
                'text' => $term,
            );
        }
        $Element['text'] [] = array(
            'name' => 'dd',
            'handler' => 'line',
            'text' => ltrim($Line['text'], ' :'),
        );
        $Block['element'] = $Element;
        return $Block;
    }

    #
    # Markup

    protected function addToDefinitionList($Line, array $Block)
    {
        if ($Line['text'][0] === ':') {
            $Block['element']['text'] [] = array(
                'name' => 'dd',
                'handler' => 'line',
                'text' => ltrim($Line['text'], ' :'),
            );
            return $Block;
        }
        if (!isset($Block['interrupted'])) {
            $Element = array_pop($Block['element']['text']);
            $Element['text'] .= "\n" . chop($Line['text']);
            $Block['element']['text'] [] = $Element;
            return $Block;
        }
    }

    #
    # Definitions
    #
    #
    # Abbreviation

    protected function identifySetext($Line, array $Block = null)
    {
        $Block = parent::identifySetext($Line, $Block);
        if (preg_match('/[ ]*' . $this->attributesPattern . '[ ]*$/', $Block['element']['text'], $matches, PREG_OFFSET_CAPTURE)) {
            $attributeString = $matches[1][0];
            $Block['element']['attributes'] = $this->parseAttributes($attributeString);
            $Block['element']['text'] = substr($Block['element']['text'], 0, $matches[0][1]);
        }
        return $Block;
    }

    #
    # Footnote

    protected function completeMarkup($Block)
    {
        $DOMDocument = new DOMDocument;
        $DOMDocument->loadXML($Block['element'], LIBXML_NOERROR | LIBXML_NOWARNING);
        if ($DOMDocument->documentElement === null) {
            return $Block;
        }
        $result = $DOMDocument->documentElement->getAttribute('markdown');
        if ($result !== '1') {
            return $Block;
        }
        $DOMDocument->documentElement->removeAttribute('markdown');
        $index = 0;
        $texts = array();
        foreach ($DOMDocument->documentElement->childNodes as $Node) {
            if ($Node instanceof DOMText) {
                $texts [] = $this->text($Node->nodeValue);
                # replaces the text of the node with a placeholder
                $Node->nodeValue = '\x1A' . $index++;
            }
        }
        $markup = $DOMDocument->saveXML($DOMDocument->documentElement);
        foreach ($texts as $index => $text) {
            $markup = str_replace('\x1A' . $index, $text, $markup);
        }
        $Block['element'] = $markup;
        return $Block;
    }

    #
    # Spans
    #
    #
    # Footnote Marker

    function text($text)
    {
        $markup = parent::text($text);
        # merge consecutive dl elements
        $markup = preg_replace('/<\/dl>\s+<dl>\s+/', '', $markup);
        # add footnotes
        if (isset($this->Definitions['Footnote'])) {
            $Element = $this->buildFootnoteElement();
            $markup .= "\n" . $this->element($Element);
        }
        return $markup;
    }

    protected function buildFootnoteElement()
    {
        $Element = array(
            'name' => 'div',
            'attributes' => array('class' => 'footnotes'),
            'handler' => 'elements',
            'text' => array(
                array(
                    'name' => 'hr',
                ),
                array(
                    'name' => 'ol',
                    'handler' => 'elements',
                    'text' => array(),
                ),
            ),
        );
        uasort($this->Definitions['Footnote'], function ($A, $B) {
            return $A['number'] - $B['number'];
        });
        foreach ($this->Definitions['Footnote'] as $name => $Data) {
            if (!isset($Data['number'])) {
                continue;
            }
            $text = $Data['text'];
            $text = $this->line($text);
            foreach (range(1, $Data['count']) as $number) {
                $text .= '&#160;<a href="#fnref' . $number . ':' . $name . '" rev="footnote" class="footnote-backref">&#8617;</a>';
            }
            $Element['text'][1]['text'] [] = array(
                'name' => 'li',
                'attributes' => array('id' => 'fn:' . $name),
                'handler' => 'elements',
                'text' => array(
                    array(
                        'name' => 'p',
                        'text' => $text,
                    ),
                ),
            );
        }
        return $Element;
    }

    #
    # Link

    protected function identifyAbbreviation($Line)
    {
        if (preg_match('/^\*\[(.+?)\]:[ ]*(.+?)[ ]*$/', $Line['text'], $matches)) {
            $Abbreviation = array(
                'id' => $matches[1],
                'data' => $matches[2],
            );
            return $Abbreviation;
        }
    }

    #
    # ~

    protected function identifyFootnote($Line)
    {
        if (preg_match('/^\[\^(.+?)\]:[ ]?(.+)$/', $Line['text'], $matches)) {
            $Footnote = array(
                'id' => $matches[1],
                'data' => array(
                    'text' => $matches[2],
                    'count' => null,
                    'number' => null,
                ),
            );
            return $Footnote;
        }
    }

    #
    # ~

    #

    protected function identifyFootnoteMarker($Excerpt)
    {
        if (preg_match('/^\[\^(.+?)\]/', $Excerpt['text'], $matches)) {
            $name = $matches[1];
            if (!isset($this->Definitions['Footnote'][$name])) {
                return;
            }
            $this->Definitions['Footnote'][$name]['count']++;
            if (!isset($this->Definitions['Footnote'][$name]['number'])) {
                $this->Definitions['Footnote'][$name]['number'] = ++$this->footnoteCount; # » &
            }
            $Element = array(
                'name' => 'sup',
                'attributes' => array('id' => 'fnref' . $this->Definitions['Footnote'][$name]['count'] . ':' . $name),
                'handler' => 'element',
                'text' => array(
                    'name' => 'a',
                    'attributes' => array('href' => '#fn:' . $name, 'class' => 'footnote-ref'),
                    'text' => $this->Definitions['Footnote'][$name]['number'],
                ),
            );
            return array(
                'extent' => strlen($matches[0]),
                'element' => $Element,
            );
        }
    }

    #
    # Private

    #

    protected function identifyLink($Excerpt)
    {
        $Span = parent::identifyLink($Excerpt);
        $remainder = substr($Excerpt['text'], $Span['extent']);
        if (preg_match('/^[ ]*' . $this->attributesPattern . '/', $remainder, $matches)) {
            $Span['element']['attributes'] += $this->parseAttributes($matches[1]);
            $Span['extent'] += strlen($matches[0]);
        }
        return $Span;
    }

    protected function readPlainText($text)
    {
        $text = parent::readPlainText($text);
        if (isset($this->Definitions['Abbreviation'])) {
            foreach ($this->Definitions['Abbreviation'] as $abbreviation => $phrase) {
                $text = str_replace($abbreviation, '<abbr title="' . $phrase . '">' . $abbreviation . '</abbr>', $text);
            }
        }
        return $text;
    }

}
