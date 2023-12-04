

<!DOCTYPE html>
<html>
<style>
</style>

<head>
  <title>Registration</title>
</head>



<body>

  <p>
    <center>
      <h1 align="center" style="color: ;">Sign Up</h1>

      <form method="post" action="../Controllers/logCheckController.php">
        
          Full NAME: <input type="text" name="name" required>
          <br><br>

          EMAIL: <input type="email" name="email" required>
          <br><br>

          User Name: <input type="text" name="username" required>
          <br><br>

          Password: <input type="text" name="newpass" required>
          <br><br>

         
          <input type="submit" value="submit">&nbsp;&nbsp;
          <br><br>


    </center>
  </p>

  </form>



</body>


<p><br></p>

<?php include('footer.php') ?>

</html>