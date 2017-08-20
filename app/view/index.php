<h2>Список заданий</h2>
<table class="table">
    <thead>
    <tr>
        <th width="100" onclick="sortTasksPager('name', <?php echo $data["pager"]->getCurrentPage(); ?>, <?php echo
        $data["auth"]->isLoggedIn() ? 'true' : 'false'; ?>);"
            style="cursor:pointer;">
            Имя <img src="/css/sort-ascend.png" height="20" /></th>
        <th onclick="sortTasksPager('email', <?php echo $data["pager"]->getCurrentPage(); ?>, <?php echo
        $data["auth"]->isLoggedIn() ? 'true' : 'false'; ?>);"
            style="cursor:pointer;">
            Email <img src="/css/sort-ascend.png" height="20" /></th>
        <th>Текст</th>
        <th onclick="sortTasksPager('done', <?php echo $data["pager"]->getCurrentPage(); ?>, <?php echo
        $data["auth"]->isLoggedIn() ? 'true' : 'false'; ?>);"
            style="cursor:pointer;">
            Выполнен <img src="/css/sort-ascend.png" height="20" /></th>
        <th width="320">Картинка</th>
        <?php if ($data["auth"]->isLoggedIn()): ?>
        <th>Изменить</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data["tasks"] as $key => $task): ?>
        <tr>
            <td><?php echo $task->getName(); ?></td>
            <td><?php echo $task->getEmail(); ?></td>
            <td><?php echo $task->getText(); ?></td>
            <td><?php echo $task->isDone() ? 'Да' : 'Нет'; ?></td>
            <td><img src="<?php echo $task->getImgUrl(); ?>" alt=""/></td>
            <?php if ($data["auth"]->isLoggedIn()): ?>
            <td><a href="/index.php?method=taskedit&id=<?php echo $task->getId(); ?>">Изменить</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div align="center">
    Страницы:
    <div id="pages">
        <?php for ($i = 0; $i < $data["pager"]->getNumberOfPages(); $i++): ?>
            <?php $data["pager"]->printPage('index', $i); ?>
            &nbsp;
        <?php endfor; ?>
    </div>
</div>
<br/>
<script src="/js/sort.js"></script>