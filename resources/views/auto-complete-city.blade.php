<!DOCTYPE html>
<html>

<head>
    <title>User list - PDF</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&libraries=places&v=3.exp"></script>
</head>

<body>
    <div class="container">
        <form>
            <div class="form-group">
                <label>City<star>*</star></label>
                <input type="text" name="city" placeholder="City" class="form-control" value="{{ old('city') }}" id="city">
            </div>
        </form>
        <script type="text/javascript">
            function initialize() {
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {
                        country: "it"
                    }
                };
                var input = document.getElementById('city');
                var autocomplete = new google.maps.places.Autocomplete(input, options);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </div>
</body>

</html>
