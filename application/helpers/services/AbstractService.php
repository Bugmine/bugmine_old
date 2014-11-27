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
 * User: Stefan
 * Date: 24.11.2014
 * Time: 19:57
 */
abstract class AbstractService
{
    /**
     * Gets a row from the database by its ID
     *
     * @param long $id
     *
     * @return Row from the database matching the ID
     */
    public abstract function GetById($id);

    /**
     * Gets one or multiple rows from the database where the value is in the column
     *
     * @param string $column
     * @param string $expression
     * @param mixed $value
     *
     * @return One or multiple rows matching the value in the given column
     */
    public abstract function Find($column, $expression, $value);

    /**
     * Deletes a row from the database by its ID
     *
     * @param long $id
     *
     */
    public abstract function Delete($id);

    /**
     * Inserts or Updates a row in the database
     *
     * @param mixed $item
     *
     */
    public abstract function Save($item);
}