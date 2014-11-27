<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2>Tickets</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Author</th>
            <th>Created</th>
        </tr>
        </thead>
        <?php for ($i = 0; $i < 10; $i++): ?>
            <?php if ($i == 2): ?>
                <tr class="info">
            <?php elseif ($i == 3): ?>
                <tr class="danger">
            <?php elseif ($i == 5): ?>
                <tr class="warning">
            <?php elseif ($i == 7): ?>
                <tr class="success">
            <?php endif; ?>
            <td><a href="test<?= $i ?>"><?= $i + 1 ?></a></td>
            <td><a href="test<?= $i ?>">TestTicket <?= $i + 1 ?></a></td>
            <td><a href="test<?= $i ?>">High</a></td>
            <td><a href="test<?= $i ?>">Security</a></td>
            <td><a href="test<?= $i ?>">Mythos</a></td>
            <td><a href="test<?= $i ?>"><?= mdate("%d.%m.%Y %H:%i:%s", now()) ?></a></td>
            </a>
            </tr>
        <?php endfor; ?>
    </table>
</div>