
<div class="row">
    <?php foreach ($this->posts as $post) : ?>
        <div class="col-sm-4">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <div><?= htmlspecialchars($post['content']) ?></div>

                <a href="/posts/edit/<?=$post['id'] ?>">[Edit]</a>
                <a href="/posts/delete/<?=$post['id'] ?>">[Delete]</a>
        </div>
    <?php endforeach ?>
</div>
<a href="/posts/create">[Create New]</a>
