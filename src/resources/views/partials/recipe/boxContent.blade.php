<table class="table table-borderless">
    @foreach ($content as $item => $value)
        <tr>
            <td><?= $item ?></td>
            <td><?= $value ?></td>
        </tr>
    @endforeach
</table>
