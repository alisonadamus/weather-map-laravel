<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">Welcome to the Weather App</h1>

    <div class="text-center mt-4">
        <a href="{{ url('/weather') }}" id="go-to-weather-page" class="btn btn-primary mt-3 w-50">Go to Weather Page</a>
    </div>

    <h3 class="mb-4">Popular Cities</h3>
    <div class="d-flex flex-wrap">
        <ul class="list-group">
            <li class="list-group-item city-item" data-city="Kyiv">Kyiv</li>
            <li class="list-group-item city-item" data-city="Lviv">Lviv</li>
            <li class="list-group-item city-item" data-city="Odessa">Odessa</li>
            <li class="list-group-item city-item" data-city="Berlin">Berlin</li>
            <li class="list-group-item city-item" data-city="Paris">Paris</li>
            <li class="list-group-item city-item" data-city="Rome">Rome</li>
            <li class="list-group-item city-item" data-city="Madrid">Madrid</li>
            <li class="list-group-item city-item" data-city="London">London</li>
            <li class="list-group-item city-item" data-city="Tokyo">Tokyo</li>
            <li class="list-group-item city-item" data-city="Seoul">Seoul</li>
            <li class="list-group-item city-item" data-city="New York">New York</li>
            <li class="list-group-item city-item" data-city="Los Angeles">Los Angeles</li>
            <li class="list-group-item city-item" data-city="Toronto">Toronto</li>
            <li class="list-group-item city-item" data-city="Mexico City">Mexico City</li>
            <li class="list-group-item city-item" data-city="Rio de Janeiro">Rio de Janeiro</li>
        </ul>
    </div>
</div>

<script>
    document.querySelectorAll('.city-item').forEach(item => {
        item.addEventListener('click', function () {
            const city = this.getAttribute('data-city');
            localStorage.setItem('city', city);

            window.location.href = `/weather?city=${city}`;
        });
    });
</script>
</body>
</html>
