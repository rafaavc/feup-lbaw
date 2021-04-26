<section id="method" class="mt-5">
    <h2 class="p-0">Method</h2>
    @php
        $i = 0
    @endphp
    @foreach ($method as $name => $info)
        @php
            $i++
        @endphp
        <section class="instruction d-inline-block col-12 mt-4">
            <h3 class="btn p-0" data-bs-toggle="collapse" href="#instruction{{ $i }}" role="button" aria-expanded="false" aria-controls="instruction{{ $i }}">
                <i class="fas fa-check-circle d-inline-block align-middle"></i>
                <span class="d-inline-block align-middle">{{ $i }}. {{ $name }}</span>
            </h3>
            <div class="collapse show" id="instruction{{ $i }}">
                <div class="d-md-flex">
                    <div class="col-md-<?= !isset($info['image']) ? "12" : "8" ?> card card-body d-inline-block p-0 mt-3">
                        {{ $info['text'] }}
                    </div>
                    <?php if (isset($info['image'])) { ?>
                        <img class="col-12 col-md-3 d-inline-block mt-3 mt-md-0 ms-md-3" src="{{ $info['image'] }}">
                    <?php } ?>
                </div>
            </div>
        </section>
    @endforeach
</section>
