<div class="container">
<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <h1 class="page-header">My Blog  </h1>
        <?php foreach ($this->posts as $post) : ?>
            <h2>
                <a href="/posts/view/<?= $post['id']?>"><?= htmlspecialchars($post['title']) ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?= htmlspecialchars($post['username']) ?></a>
            </p>
            <p>
                <span class="glyphicon glyphicon-time">
                </span>
                <?= htmlspecialchars($post['date_stamp']) ?>
            </p>
            <p><?= htmlspecialchars(substr($post['content'],0,100)) ?></p>
            <p class="lead">
                by <a href="index.php"><?= htmlspecialchars($post['username']) ?></a>
            </p>
            <?php if($this->auth->isLoggedIn()
                && $this->auth->get_logged_user()[0] == $post['username']
                || $this->auth->isAdmin()): ?>
                <a class="btn btn-primary" href="/posts/edit/<?=$post['id'] ?>">Edit</a>
                <a class="btn btn-danger" href="/posts/delete/<?=$post['id'] ?>">Delete</a>
            <?php endif ?>
            <hr>
        <?php endforeach ?>


        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="/posts/page/<?= $this->page - 1?>/<?= $this->pagesize ?>">< Older</a>
            </li>
            <li class="next">
                <a href="/posts/page/<?= $this->page + 1?>//<?= $this->pagesize ?>">Newer ></a>
            </li>
        </ul>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            </div>
            <!-- /.input-group -->
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Tags</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <div class="well">
            <h4>Archive</h4>
        </div>

    </div>
</div>
