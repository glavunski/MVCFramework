<h2>
    <?= htmlspecialchars($this->post['title']) ?>
</h2>
<p class="lead">
    by <?= htmlspecialchars($this->post['username']) ?>
</p>
<p>
    <span class="glyphicon glyphicon-time"></span>
    <?= htmlspecialchars($this->post['date_stamp']) ?>
</p>
<p><?= htmlspecialchars($this->post['content']) ?></p>
<a href="/posts/edit/<?=$this->post['id'] ?>">[Edit]</a>
<a href="/posts/delete/<?=$this->post['id'] ?>">[Delete]</a>