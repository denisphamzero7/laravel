<form action="/unicode" method="POST">
    <div>
        <input type="text" name="name" placeholder="Nhập name..">
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <button type="submit">Post </button>
    </div>
</form>
