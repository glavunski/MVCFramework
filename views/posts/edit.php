<h1>Edit Existing User</h1>

<?php if ($this->user) { ?>
<form method="post" action="/users/edit/<?= $this->user['id'] ?>">
    Author name:
    <input type="text" name="name"
        value="<?= htmlspecialchars($this->user['username']) ?>" />
    <br/>
    <input type="submit" value="Edit" />
    <a href="/users">Cancel</a>
</form>
<?php } ?>
