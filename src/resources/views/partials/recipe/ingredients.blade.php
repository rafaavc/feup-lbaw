<section id="ingredients" class="mt-5">
    <h2 class="p-0 mb-4">Ingredients</h2>
    <table class="table table-striped p-3">
        @foreach ($ingredients as $idx => $ingredient)
            <tr>
                <td class="quantity">{{$ingredient->pivot->quantity}} {{ strtolower(\App\Models\Unit::find($ingredient->pivot->id_unit)->name) }}</td>
                <td>{{$ingredient->name}}</td>
            </tr>
        @endforeach
    </table>
</section>
