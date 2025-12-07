<section
    class="container cat-section cat-section-buttons d-none d-md-flex flex-wrap justify-content-between align-items-center">
    @foreach ($cities as $city)
        <a class="btn-primary text-center" href="{{ url('jobs?city=' . $city->id) }}">{{ $city->name }}</a>
    @endforeach
</section>
