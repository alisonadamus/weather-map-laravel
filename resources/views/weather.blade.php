<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">Weather Application</h1>

    <div class="d-flex justify-content-start mb-4">
        <a href="{{ url('/') }}" class="btn btn-secondary">Back to Main Page</a>
    </div>

    <div class="mb-4">
        <input type="text" id="city-input" class="form-control" placeholder="Enter city name" value="{{ $city ?? '' }}">
        <button id="get-weather-btn" class="btn btn-primary mt-3 w-100">Get Weather For Now</button>
        <button id="get-weekly-weather-btn" class="btn btn-info mt-3 w-100">Get Weekly Weather</button>
    </div>

    <div id="weather-result" class="text-center bg-white p-4 rounded shadow-sm" style="display: none;">
        <h3 id="city-name"></h3>
        <img id="weather-icon" alt="Weather icon" />
        <p id="temperature"></p>
        <p id="description"></p>
        <hr />
    </div>

    <div id="weekly-weather-result" class="text-center bg-white p-4 rounded shadow-sm" style="display: none;">
        <h3>Weekly Weather Forecast</h3>
        <div id="weekly-weather"></div>
    </div>

    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
</div>

<script>
    $('#get-weather-btn').click(function () {
        const city = $('#city-input').val();

        if (!city) {
            $('#error-message').text('Please enter a city name').show();
            $('#weather-result').hide();
            return;
        }

        $('#error-message').hide();
        $('#weather-result').hide();

        $.ajax({
            url: "{{ route('weather.get') }}",
            method: "GET",
            data: { city: city },
            success: function (data) {
                $('#city-name').text(`Weather in ${data.name}`);
                $('#temperature').text(`Temperature: ${data.main.temp}°C`);
                $('#description').text(`Condition: ${data.weather[0].description}`);

                const iconCode = data.weather[0].icon;
                const iconUrl = `http://openweathermap.org/img/wn/${iconCode}@2x.png`; // URL для іконки

                $('#weather-icon').attr('src', iconUrl);

                $('#weather-result').show();
            },
            error: function (xhr) {
                const error = xhr.responseJSON.error || 'An error occurred';
                $('#error-message').text(error).show();
            }
        });

        $('#get-weekly-weather-btn').click(function () {
            const city = $('#city-input').val();

            if (!city) {
                $('#error-message').text('Please enter a city name').show();
                $('#weekly-weather-result').hide();
                return;
            }

            $('#error-message').hide();
            $('#weekly-weather-result').hide();

            $.ajax({
                url: "{{ route('weather.weekly.get') }}",
                method: "GET",
                data: { city: city },
                success: function (data) {
                    let weeklyWeatherHtml = '';
                    data.list.forEach(function (forecast) {
                        const date = new Date(forecast.dt * 1000);


                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        const formattedDate = date.toLocaleDateString('en-US', options);

                        const iconCode = forecast.weather[0].icon;
                        const iconUrl = `http://openweathermap.org/img/wn/${iconCode}@2x.png`; // URL для іконки

                        weeklyWeatherHtml += `
                    <div class="mb-2">
                        <strong>${formattedDate}</strong><br>
                        <img src="${iconUrl}" alt="Weather icon" /> <br>
                        Temp: ${forecast.main.temp}°C<br>
                        Condition: ${forecast.weather[0].description}
                    </div>
                    <hr />
                `;
                    });
                    $('#weekly-weather').html(weeklyWeatherHtml);
                    $('#weekly-weather-result').show();
                },
                error: function (xhr) {
                    const error = xhr.responseJSON.error || 'An error occurred';
                    $('#error-message').text(error).show();
                }
            });
        });
    });
</script>
</body>
</html>
