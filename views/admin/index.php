<div class="container">
<table data-toggle="table" data-url="data1.json" data-cache="false" data-height="299">
    <thead>
        <tr>
            <th data-field="id">User Id</th>
            <th data-field="name">User Name</th>
            <th data-field="email">Email</th>
            <th data-field="isadmin">IsAdmin</th>
        </tr>
        <?php foreach($this->users as $user): ?>
            <tr>
                <td data-field="id"><?= $user['id'] ?></td>
                <td data-field="name"><?= $user['username'] ?></td>
                <td data-field="email"><?= $user['email'] ?></td>
                <td data-field="isadmin"><?= $user['is_admin'] == 1 ? "yes" : "no" ?></td>
                <td><a href="admin/delete/<?= $user['id'] ?>">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </thead>
</table>
</div>