<section id="ingredients" class="mt-5">
    <h2 class="p-0 mb-4">Ingredients</h2>
    <table class="table table-striped p-3">
        @foreach ($ingredients as $ingredient => $quantity)
            <tr>
                <td class="quantity"><?= $quantity ?></td>
                <td><?= $ingredient ?></td>
            </tr>
        @endforeach
    </table>
</section>
