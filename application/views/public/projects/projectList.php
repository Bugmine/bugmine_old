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
 * Date: 30.11.2014
 * Time: 16:21
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2><?php echo $title ?></h2>
<ul>
    <?php foreach ($projects as $project): ?>
        <li>
            <a href="project/<?php echo $project->getIdentifier(); ?>"><?php echo $project->getName(); ?></a>
            <?php if (strlen($project->getDescription()) > 0): ?>
                <br/><?php echo $project->getDescription(); ?>
            <?php endif; ?>
            <?php if (strlen($project->getWebsite()) > 0): ?>
                <br/><a href="<?php echo $project->getWebsite(); ?>"><?php echo $project->getWebsite(); ?></a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>