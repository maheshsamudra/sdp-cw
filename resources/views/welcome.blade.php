<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Environmental Crime Reporting System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
        /* Customize styles as needed */
        body {
            background-color: #d4edda;
        }

        .jumbotron {
            background-color: #28a745;
            color: #fff;
            padding: 80px 30px;
            margin-bottom: 0;
            /* Remove default margin */
        }

        .btn-green {
            background-color: #218838;
            color: #fff;
        }

        .btn-green:hover {
            background-color: #269d40;
            /* Light green on hover */
            color: #fff;
            /* White text on hover */
        }

        .bg-light-green {
            background-color: #d4edda;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">EnviroWatch</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    @if (!Auth::user())
                    <li class="nav-item">
                        <a class="btn btn-green ml-2" href="#download-app" role="button">Download App</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-green ml-2" href="{{ route('login') }}" role="button">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-green ml-2" href="{{ route('register') }}" role="button">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-green ml-2" href="/dashboard" role="button">Dashboard</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron text-center mb-4 animate__animated animate__fadeIn">
        <div class="container">
            <h1 class="display-4">Report Environmental Crimes</h1>
            <p class="lead">Empower the community to protect wildlife, forests, and the environment.</p>
            <a class="btn btn-green btn-lg" href="#download-app" role="button">Report Now</a>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="container mb-4 animate__animated animate__fadeIn" id="about-us">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 text-center mb-4">
                    <h2>Save Wildlife</h2>
                </div>
                <p class="text-center">EnviroWatch is dedicated to safeguarding our environment. We believe in the power of community-driven actions to combat environmental crimes.</p>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1655659260883-dd91f2c63ec1?q=80&w=1635&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="About Us Image" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Download App Section -->
    <div class="container mb-4 text-center animate__animated animate__fadeIn">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1589705320079-4fd380c4e9f4?q=80&w=1635&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Download App Image" class="img-fluid mb-4">
            </div>
            <div class="col-md-6 ">
                <h2>Save Forests</h2>
                <p class="text-center">EnviroWatch is dedicated to safeguarding our environment. We believe in the power of community-driven actions to combat environmental crimes.</p>
            </div>
        </div>
    </div>

    <div class="container text-center my-5 py-6" id="download-app">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2>Save Forests</h2>
                <p class="text-center">EnviroWatch is dedicated to safeguarding our environment. We believe in the power of community-driven actions to combat environmental crimes.</p>
                <a class="btn btn-green btn-lg" href="#download-app" role="button">Download Now</a>
            </div>
            <div class="col-12">

            </div>

            <div class="col-2 mt-5">
                <hr>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mb-5 p-3 bg-light-green animate__animated animate__fadeIn" id="contact">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <h2>Contact Us</h2>
                <p>We'd love to hear from you! Reach out to us through the following channels:</p>
                <ul class="list-unstyled">
                    <li>Email: info@envirowatch.com</li>
                    <li>Phone: +1 (555) 123-4567</li>
                    <li>Address: 123 Green Street, Eco City</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container text-center">
            <p>&copy; 2023 EnviroWatch</p>
        </div>
    </footer>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
