<html>  
<head>  
    <title>Events</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 .error
{
  color: red;
  font-weight: 700;
} 
</style>
<?php 
include('db_connection.php');
if(isset($_POST['save-event']))
{
  $title = $_POST['title'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $student = $_POST['student'];

  $insert_query = mysqli_query($conn, "INSERT INTO event (title, start_date, end_date, student) VALUES ('$title', '$start_date', '$end_date', '$student')");

  if ($insert_query) {
    header('location:view-calendar.php');
  } else {
    $msg = "Event not created. Error: " . mysqli_error($conn);
  }
}
?>

<!-- ... rest of the HTML form ... -->

<body> 
<header>
    <a href="adminhome.php" id="home-link">Admin Home</a>
        
    </header> 
    <div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Create Event</h3><br/>
    <div class="box">
     <form method="post"  >  
       <div class="form-group">
       <label for="title">Enter Title of the Event</label>
       <input type="text" name="title" id="title" placeholder="Enter Title" required 
       data-parsley-type="title" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="student">Enter student</label>
       <input type="text" name="student" id="student" placeholder="Enter student" required 
       data-parsley-type="student" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="date">Start Date</label>
       <input type="date" name="start_date" id="start_date" required 
       data-parsley-type="date" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="date">End Date</label>
       <input type="date" name="end_date" id="end_date" required 
       data-parsley-type="date" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <input type="submit" id="save-event" name="save-event" value="Save Event" class="btn btn-success" />
       </div>
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
 </body>  
</html> 