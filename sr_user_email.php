<h1>ユーザ登録用メールアドレス入力</h1>

<form method="POST" action="sr_user_index.php" class="form-horizontal">
    <input type="hidden" name="mode" value="email_confirm">

    <div class="form-group">
            <label for="email" class="col-sm-3 control-label">メールアドレス</label>
            <div class="col-sm-9">
                <input class="form-control input-lg" type="email" id="email" name="email" placeholder="aaa@bbb.com" />
            </div>
    </div>
    
    <p class="text-center"><input type="submit" name="submit" class="btn btn-default btn-lg" value="確認"></p>

</form>