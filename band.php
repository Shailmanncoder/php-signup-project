<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Band Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        /* Navbar Styling */
        .navbar {
            background-color: #222;
            border: none;
            margin-bottom: 0;
        }
        .navbar-nav {
            float: right !important;
        }
        .navbar-nav > li > a {
            color: white !important;
            font-size: 16px;
            padding: 15px 20px;
        }
        .navbar-brand img {
            height: 40px;
        }
        .navbar-form {
            padding: 8px;
            margin-right: 50px; /* Moves search bar slightly left */
        }
        .form-control {
            width: 200px;
        }
        /* Tour Section */
        #tour {
            text-align: center;
            background-color: #222;
            color: white;
            padding: 50px;
        }
        .tour-dates {
            background-color: white;
            color: black;
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
        }
        .sold-out {
            background-color: #d9534f;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .tour-card {
            background: white;
            color: black;
            padding: 15px;
            border-radius: 5px;
            margin: 15px;
            text-align: center;
        }
        .tour-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn-buy {
            background-color: black;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            margin-top: 10px;
        }
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        /* Navbar adjustments for mobile */
@media (max-width: 767px) {
    .navbar-nav {
        float: none !important;
        margin: 0;
    }
    .navbar-nav > li > a {
        padding: 10px 15px; /* Reduce padding for mobile */
    }
    .navbar-form {
        margin: 0;
        padding: 10px 15px;
    }
    .navbar-collapse {
        overflow-y: auto; /* Allow scrolling if the menu is too tall */
    }
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#"><img src="band-logo.jfif" alt="Logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">HOME</a></li>
                <li><a href="#about">About us</a></li>
                <li><a href="#tour">TOUR</a></li>
                <li><a href="#contact">CONTACT</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">MORE <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Merchandise</a></li>
                        <li><a href="#">Extras</a></li>
                        <li><a href="#">Media</a></li>
                    </ul>
                </li>
                <li>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <div class="item active">
            <img src="chicago.jpg" class="d-block" style="height:500px;width:100%" alt="home-essential">
            <div class="carousel-caption">
                <h3>Chicago</h3>
                <p>Experience the vibrant city life of Chicago!</p>
            </div>
        </div>

        <div class="item">
            <img src="la.jpg" class="d-block" style="height:500px;width:100%" alt="electronics">
            <div class="carousel-caption">
                <h3>Los Angeles</h3>
                <p>Feel the glamour of Hollywood in LA!</p>
            </div>
        </div>

        <div class="item">
            <img src="ny.jpg" class="d-block" style="height:500px;width:100%" alt="gaming">
            <div class="carousel-caption">
                <h3>New York</h3>
                <p>The city that never sleeps!</p>
            </div>
        </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>


<!-- The Band Section -->
<div id="about" class="container text-center" style="padding: 50px;height:auto;">
    <h2>THE BAND</h2>
    <p><em>We love music!</em></p>
    <p>We have created a fictional band to showcase our love for music.</p>
    
    <!-- Images Below THE BAND Text -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-sm-4">
            <img src="member1.jpg" alt="Band Image 1" style="width:100%; height:300px; object-fit:cover; border-radius:5px;">
        </div>
        <div class="col-sm-4">
            <img src="member2.jpg" alt="Band Image 2" style="width:100%; height:300px; object-fit:cover; border-radius:5px;">
        </div>
        <div class="col-sm-4">
            <img src="member3.jpg" alt="Band Image 3" style="width:100%; height:300px; object-fit:cover; border-radius:5px;">
        </div>
    </div>
</div>


<!-- Tour Section -->
<div id="tour">
    <h2>TOUR DATES</h2>
    <p><em>Lorem ipsum we'll play you some music.<br>Remember to book your tickets!</em></p>
    
    <!-- Ticket Availability -->
    <div class="tour-dates">
        <p style="text-align:left;">September <span style="text-align:left;" class="sold-out">Sold Out!</span></p>
        <hr>
        <p style="text-align:left;">October <span style="text-align:left;" class="sold-out">Sold Out!</span></p>
        <hr>
        <p style="text-align:left;">November <span class="badge"style="text-align:left;">3</span></p>
        <hr>
    </div>

    <!-- Tour Locations -->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="tour-card">
                    <img src="paris.jpg" alt="Paris">
                    <h4><i>Paris</i></h4>
                    <p>Tuesday 8 November 2015</p>
                    <button class="btn btn-buy" data-toggle="modal" data-target="#myModal">Buy Tickets</button>


                </div>
            </div>
            <div class="col-sm-4">
                <div class="tour-card">
                    <img src="newyork.jpg" alt="New York">
                    <h4><i>New York</i></h4>
                    <p>Saturday 28 November 2015</p>
                    <button class="btn btn-buy" data-toggle="modal" data-target="#myModal">Buy Tickets</button>



                </div>
            </div>
            <div class="col-sm-4">
                <div class="tour-card">
                    <img src="sanfran.jpg" alt="San Francisco">
                    <h4><i>San Francisco</i></h4>
                    <p>Saturday 18 december 2015</p>
                    <button class="btn btn-buy" data-toggle="modal" data-target="#myModal">Buy Tickets</button>



                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section -->
<div id="contact" style="background-color: #f8f9fa; padding: 50px; text-align: center;">
    <h2>CONTACT</h2>
    <p><em>We love our fans!</em></p>
    <form style="max-width: 600px; margin: auto;">
        <table style="width: 100%;">
            <tr>
                <td style="padding: 10px;"><input type="text" placeholder="Name" style="width: 100%; padding: 10px;"></td>
                <td style="padding: 10px;"><input type="email" placeholder="Email" style="width: 100%; padding: 10px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px;"><textarea placeholder="Comment" style="width: 100%; padding: 10px; height: 100px;"></textarea></td>
            </tr>
        </table>
        <button type="submit" style="background-color: black; color: white; border: none; padding: 10px 20px; margin-top: 20px;">Send</button>
    </form>
    <p style="margin-top: 30px;">Fan? Drop a note.</p>
    <p>
        <input type="checkbox" id="chicago" name="chicago">
        <label for="chicago">Chicago, US</label>
    </p>
    <p>Phone: +00 1515151515</p>
    <p>Email: <a href="mailto:mail@mail.com">mail@mail.com</a></p>
</div>
<!-- From The Blog Section -->
<div id="blog" class="container text-center" style="padding: 50px;">
    <h2>FROM THE BLOG</h2>
    <p><em>Latest news and stories from our band members!</em></p>
    
    <div class="row">
        <div class="col-sm-12">
            <img src="map.jpg" alt="Blog Image" style="width:100%; height:400px; object-fit:cover; border-radius:5px; margin-bottom:20px;">
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <h3>Mike Ross, Manager</h3>
            <p>"Man, we've been on the road for some time now. Looking forward to some rest after this tour."</p>
        </div>
        <div class="col-sm-4">
            <h3>Chandler Bing, Guitarist</h3>
            <p>"Always a pleasure performing! Hope you enjoyed it as much as I did. Could I BE any more excited?"</p>
        </div>
        <div class="col-sm-4">
            <h3>Peter Griffin, Bass Player</h3>
            <p>"I mean, sometimes I enjoy the show, but other times I enjoy other things. Keep rocking!"</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center" style="background-color: #2d2d30; color: white; padding: 32px; margin-top: 50px;">
    <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP" style="color: white; font-size: 20px; display: block; margin-bottom: 10px;">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Band Website by <a href="#" style="color: white;">Your Name</a></p>
</footer>

<script>
$(document).ready(function(){
    $("#ticketForm").submit(function(event){
        event.preventDefault(); // Prevent Default Form Submission
        
        $.ajax({
            url: "insert_ticket.php", // PHP file to handle database insertion
            type: "POST",
            data: $(this).serialize(), // Serialize form data
            success: function(response){
                if(response.trim() === "success") {
                    alert("Ticket Booked Successfully!");
                    window.location.href = "tickets_table.php"; // Redirect to ticket table
                } else {
                    alert("Error: " + response);
                }
            }
        });
    });
});
</script>


<!-- Ticket Modal -->
<!-- Ticket Purchase Modal -->
<!-- Ticket Purchase Modal -->
<!-- Ticket Purchase Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <form id="ticketForm"> <!-- Added Form -->
                <div class="modal-header" style="background-color: #333; color: white; text-align: center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-lock"></span> Tickets
                    </h4>
                </div>
                <div class="modal-body">
                    <p><span class="glyphicon glyphicon-shopping-cart"></span> Tickets, $23 per person</p>
                    <input type="number" id="person" name="person" style="width:100%;"class="form-control" placeholder="How many?" required min="1">

                    <p style="margin-top: 15px;"><span class="glyphicon glyphicon-user"></span> Send To</p>
                    <input type="email" id="email" name="email" style="width:100%;"class="form-control" placeholder="Enter email" required>

                    <!-- Country Dropdown -->
                    <p style="margin-top: 15px;"><span class="glyphicon glyphicon-globe"></span> Select Country</p>
                    <select id="country" name="country" class="form-control" style="width:100%;"required>
                        <option value=""disable hidden selected>Select Country</option>
                        <option value="Paris">Paris</option>
                        <option value="New york">New york</option>
                        <option value="San Francisco">San Francisco</option>
                    </select>
                </div>
                <div class="modal-footer text-center">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-dark" style="background-color: black; color: white;">
                                <span class="glyphicon glyphicon-ok"></span> Pay
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form> <!-- Form Ends Here -->
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $("#ticketForm").submit(function(event){
        event.preventDefault(); // Prevent Default Form Submission
        
        $.ajax({
            url: "insert_ticket.php", // PHP file to handle database insertion
            type: "POST",
            data: $(this).serialize(), // Serialize form data
            success: function(response){
                if(response.trim() === "success") {
                    alert("Ticket Booked Successfully!");
                    window.location.href = "manage_tickets.php"; // Redirect to ticket management page
                } else {
                    alert("Error: " + response);
                }
            }
        });
    });
});
</script>




</body>
</html>