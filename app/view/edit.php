<h2>Редактировать задание</h2>
<form method="post" action="index.php?method=taskedit&id=<?php echo $data["task"]->getId(); ?>" role="form">

    <div class="form-group">
        <label for="text">Текст задачи</label>
        <textarea class="form-control" name="text" id="text" placeholder="Текст задачи" rows="8"><?php
            echo $data["task"]->getText(); ?></textarea>
    </div>

    <div class="form-group">
        <label for="done">Выполнено</label>
        <input name="done" type="checkbox" value="yes" <?php echo $data["task"]->isDone() ? 'checked="checked"' : ''; ?> /> Да
    </div>

    <div class="form-group">
        <input class="btn btn-success" type="submit" value="Обновить"/>
    </div>
</form>