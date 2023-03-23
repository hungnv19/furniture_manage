<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            color: #fff;
            overflow-x: hidden;
            height: 100%;
            background-image: linear-gradient(#81D4FA, #2196F3);
            background-repeat: no-repeat;
        }

        .card0 {
            width: 94%;
        }

        .card1 {
            background-image: linear-gradient(#2196F3, #81D4FA);
            padding: 30px 20px 30px 50px;
        }

        .image {
            width: 300px;
            height: 300px;
        }

        .large-font {
            font-size: 70px;
            font-family: Arial;
        }

        .fa-sun-o {
            font-size: 22px;
        }

        .card2 {
            background-color: #607D8B;
            padding: 0px 0px 40px 40px;
        }

        input {
            background-color: #607D8B;
            padding: 24px 0px 12px 0px !important;
            width: 80%;
            box-sizing: border-box;
            border: none !important;
            border-bottom: 1px solid #CFD8DC !important;
            font-size: 16px !important;
            color: #fff !important;
        }

        input:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border-bottom: 1px solid #fff !important;
            outline-width: 0;
            font-weight: 400;
        }

        ::placeholder {
            color: #B0BEC5 !important;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: #B0BEC5 !important;
        }

        ::-ms-input-placeholder {
            color: #B0BEC5 !important;
        }

        .fa-search {
            color: #607D8B;
            background-color: #E1F5FE;
            font-size: 20px;
            padding: 20px;
            width: 20%;
            cursor: pointer;
        }

        .light-text {
            color: #B0BEC5;
        }

        .suggestion:hover {
            color: #fff;
            cursor: pointer;
        }

        .line {
            height: 1px;
            background-color: #B0BEC5;
        }

        @media screen and (max-width: 500px) {
            .card1 {
                padding-left: 26px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-1 px-sm-3 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="row card0">
                <a  href="{{route('login.create')}}" class="btn btn-primary" style="margin-bottom: 10px" >Login</a>
            </div>

            
            <div class="row card0">
                <div class="card1 col-lg-8 col-md-7">
                    <small>the.weather</small>
                    <div class="text-center">
                        <img class=" mt-5" >
                    </div>
                    <div class="row px-3 mt-3 mb-3">
                        <h1 class="large-font mr-3">26&#176;</h1>
                        <div class="d-flex flex-column mr-3">
                            <h2 class="mt-3 mb-0">London</h2>
                            <small>10:36 - Tuesday, 22 Oct '19</small>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <h3 class="fa fa-sun-o mt-4"></h3>
                            <small>Sunny</small>
                        </div>
                    </div>
                </div>
                <div class="card2 col-lg-4 col-md-5">
                    <div class="row px-3">
                        <input type="text" name="location" placeholder="Another location" class="mb-5">
                        <div class="fa fa-search mb-5 mr-0 text-center"></div>
                    </div>
                    <div class="mr-5">
                        <p class="light-text suggestion">Birmingham</p>
                        <p class="light-text suggestion">Manchester</p>
                        <p class="light-text suggestion">New York</p>
                        <p class="light-text suggestion">California</p>

                        <div class="line my-5"></div>

                        <p>Weather Details</p>
                        <div class="row px-3">
                            <p class="light-text">Cloudy</p>
                            <p class="ml-auto">12%</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Humidity</p>
                            <p class="ml-auto">78%</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Wind</p>
                            <p class="ml-auto">1km/h</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Rain</p>
                            <p class="ml-auto">0mm</p>
                        </div>

                        <div class="line mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
