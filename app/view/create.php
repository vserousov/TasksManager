<div style="float:left; width: 500px;">
    <h2>Добавить задание</h2>
    <form method="post" action="index.php?method=taskcreate" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Имя пользователя">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
        </div>

        <div class="form-group">
            <label for="text">Текст задачи</label>
            <textarea class="form-control" name="text" id="text" placeholder="Текст задачи" rows="8"></textarea>
        </div>


        <div class="form-group">
            <label for="image">Картинка</label>
            <input type="file" class="form-control" name="image" id="image" placeholder="image">
        </div>

        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Добавить"/>
            <button type="button" class="btn btn-info" onclick="preview();">Предварительный просмотр</button>
        </div>
    </form>
</div>

<div style="float:right; width: 500px; margin-top: 20px;" id="preview">
    <img id="previewImg" />
</div>

<script src="/js/preview.js"></script>