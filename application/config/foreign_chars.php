<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
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
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright    Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    http://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Foreign Characters
| -------------------------------------------------------------------
| This file contains an array of foreign characters for transliteration
| conversion used by the Text helper
|
*/
$foreign_characters = array(
    '/ä|æ|ǽ/' => 'ae',
    '/ö|œ/' => 'oe',
    '/ü/' => 'ue',
    '/Ä/' => 'Ae',
    '/Ü/' => 'Ue',
    '/Ö/' => 'Oe',
    '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
    '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
    '/Б/' => 'B',
    '/б/' => 'b',
    '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
    '/ç|ć|ĉ|ċ|č/' => 'c',
    '/Д/' => 'D',
    '/д/' => 'd',
    '/Ð|Ď|Đ|Δ/' => 'Dj',
    '/ð|ď|đ|δ/' => 'dj',
    '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
    '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
    '/Ф/' => 'F',
    '/ф/' => 'f',
    '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
    '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
    '/Ĥ|Ħ/' => 'H',
    '/ĥ|ħ/' => 'h',
    '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
    '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
    '/Ĵ/' => 'J',
    '/ĵ/' => 'j',
    '/Ķ|Κ|К/' => 'K',
    '/ķ|κ|к/' => 'k',
    '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
    '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
    '/М/' => 'M',
    '/м/' => 'm',
    '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
    '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
    '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
    '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
    '/П/' => 'P',
    '/п/' => 'p',
    '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
    '/ŕ|ŗ|ř|ρ|р/' => 'r',
    '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
    '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
    '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
    '/ț|ţ|ť|ŧ|т/' => 't',
    '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
    '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
    '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
    '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
    '/В/' => 'V',
    '/в/' => 'v',
    '/Ŵ/' => 'W',
    '/ŵ/' => 'w',
    '/Ź|Ż|Ž|Ζ|З/' => 'Z',
    '/ź|ż|ž|ζ|з/' => 'z',
    '/Æ|Ǽ/' => 'AE',
    '/ß/' => 'ss',
    '/Ĳ/' => 'IJ',
    '/ĳ/' => 'ij',
    '/Œ/' => 'OE',
    '/ƒ/' => 'f',
    '/ξ/' => 'ks',
    '/π/' => 'p',
    '/β/' => 'v',
    '/μ/' => 'm',
    '/ψ/' => 'ps',
    '/Ё/' => 'Yo',
    '/ё/' => 'yo',
    '/Є/' => 'Ye',
    '/є/' => 'ye',
    '/Ї/' => 'Yi',
    '/Ж/' => 'Zh',
    '/ж/' => 'zh',
    '/Х/' => 'Kh',
    '/х/' => 'kh',
    '/Ц/' => 'Ts',
    '/ц/' => 'ts',
    '/Ч/' => 'Ch',
    '/ч/' => 'ch',
    '/Ш/' => 'Sh',
    '/ш/' => 'sh',
    '/Щ/' => 'Shch',
    '/щ/' => 'shch',
    '/Ъ|ъ|Ь|ь/' => '',
    '/Ю/' => 'Yu',
    '/ю/' => 'yu',
    '/Я/' => 'Ya',
    '/я/' => 'ya'
);

/* End of file foreign_chars.php */
/* Location: ./application/config/foreign_chars.php */