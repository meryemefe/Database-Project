<html >
	<head> 
		<title> CSCareer</title>
		<link rel="stylesheet" href="css/styles.css">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/developer-solve-quiz-style.css">
		<link rel="stylesheet" href="css/navbar-style.css">
		
		<style>
            .btn {
            padding: 5px 28px;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
            }

           <!-- .success {color: green;}
            .danger {color: red;}-->
        </style> 
        <style scoped>
        .greenText {color:green;}
        </style>
        <style scoped>
        .redText {color:red;}
        </style>

        <style>
			body, html {
			height: 100%;
			margin: 0;
			}

			.bg {
			/* The image used */
			background-image: url("background.png");

			/* Full height */
			height: 100%; 

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
            
            .a {
  			margin: 0px 0px 30px 0px;
  			
			}
		</style>
		
	
	</head>
	
	<body>
	
	<nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark">
			<a class="navbar-brand" href="#">CSCareer</a>

				<ul class="navbar-nav mr-auto d-print leftm">
					<li class="nav-item">
						<a class="nav-link" href="developer.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="developer-profile.php">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="developer_solve_quiz.php">Attempt Quiz</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="developer_result.php">Quiz Results</a>
					</li>
					
					<li class="nav-item active">
						<a class="nav-link" href="#">Interview Requests <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				
				<ul class = "navbar-nav navbar-right d-print rightm">
					<li>
					<a class="nav-link" href = "logout.php"><svg class="bi bi-box-arrow-in-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M7.854 11.354a.5.5 0 000-.708L5.207 8l2.647-2.646a.5.5 0 10-.708-.708l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708 0z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M15 8a.5.5 0 00-.5-.5h-9a.5.5 0 000 1h9A.5.5 0 0015 8z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M2.5 14.5A1.5 1.5 0 011 13V3a1.5 1.5 0 011.5-1.5h8A1.5 1.5 0 0112 3v1.5a.5.5 0 01-1 0V3a.5.5 0 00-.5-.5h-8A.5.5 0 002 3v10a.5.5 0 00.5.5h8a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V13a1.5 1.5 0 01-1.5 1.5h-8z" clip-rule="evenodd"/>
					</svg>Log Out</a>
					 </li>
				</ul>
		</nav>
	
    <div class="bg">
		<div class = "container">
		<div class ="text-center">
		<h1 class="a"  >Interview Requests</h1>
		</div>
		<?php
			require_once ('connect.php');
			session_start();
            $initialClick = 1;
            $developer_id = $_SESSION['developer_id'];
            date_default_timezone_set('Europe/Istanbul');
            $date = date("Y/m/d");
            $sql = "SELECT acceptedStatus, request_id, job_description, developer_id, representative_id, fullname, user_id, due_date FROM request JOIN User WHERE developer_id = {$developer_id} AND representative_id = user_id AND  due_date >= '{$date}' ";
            $result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
			
			echo "<div class = container>";
            echo "<div class='row'>";
            echo "<div class = 'col-3'><h3>Representative</h3> </div>";
            echo "<div class = 'col-3'><h3>Job Description</h3> </div>";
            echo "<div class = 'col-3'><h3>Due Date</h3> </div>";
            echo "<div class = 'col-3'><h3>Interview Request</h3> </div>";

            echo "</div>";
			while ($row = mysqli_fetch_array ($result)) {
                echo "<div class='row'>";
                echo "<div class = 'col-3'><h4>{$row['fullname']}</h4></div>";
                echo "<div class = 'col-3'><h4>{$row['job_description']}</h4></div>";
                echo "<div class = 'col-3'><h4> {$row['due_date']}</h4></div>";
                
                if( $row['acceptedStatus'] == 'sent'){
                    echo "<form action='update_request_status.php?request_id={$row['request_id']}' method='post'>";
                    echo "<div class = 'col-3' > <button class='btn btn-success' name='subject' type='submit' value='accepted'>Accept</button></div>
                         <div class = 'col-3' ><button class='btn btn-danger' name='subject' type='submit' value='declined'>Decline</button> </div>";
                    echo "</form>";
                }
                elseif( $row['acceptedStatus'] == 'declined'){
                    echo "<div class = 'col-3'><h4 class = redText>Declined</h4></div>";
                }else{
                    echo "<div class = 'col-3'><h4 class = greenText>Accepted</h4></div>";
                }
                
                echo "</div> ";

            }

            
		
			

			

        ?>

		</div>
		</div>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>	
		
	</body>
	

</html>