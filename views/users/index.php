<h1>List of Authors</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th colspan="2">Action</th>
    </tr>
    <?php foreach ($this->users as $user) : ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><a href="/users/edit/<?=$user['id'] ?>">[Edit]</td>
            <td><a href="/users/delete/<?=$user['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/authors/create">[Create New]</a>
