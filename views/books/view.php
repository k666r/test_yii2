<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"></h4>
</div>
<div class="modal-body">
    <table class="table table-bordered table-considered">
        <thead>
        <tr>
            <th>Аттрибут</th>
            <th>Значение</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>id</td>
            <td><?= $book->id; ?></td>
        </tr>
        <tr>
            <td>title</td>
            <td><?= $book->title; ?></td>
        </tr>
        <tr>
            <td>author_id</td>
            <td><?= $book->author_id; ?></td>
        </tr>
        <tr>
            <td>date_created</td>
            <td><?= $book->date_created; ?></td>
        </tr>
        <tr>
            <td>date_added</td>
            <td><?= $book->date_added; ?></td>
        </tr>
        <tr>
            <td>preview</td>
            <td><?= $book->preview; ?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">

</div>
