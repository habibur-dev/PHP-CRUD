<?php include "action.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>PHP || CRUD</title>
    <style>
      @import "compass/css3";
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <h4 class="text-center mt-4 mb-4">Advanced CRUD App Using Bootstrap 4, PHP & MySQLi Prepared Statement In Object Oriented</h4>
          <hr>
          <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['res_type']; ?> alert-dismissible tex-center">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <b class="text-center"><?php echo $_SESSION['response']; ?></b>
            </div>
        <?php } unset($_SESSION['response']);  ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h5 class="text-center text-info">Add Record</h5>
          <form action="action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group">
              <input type="text" name="name" placeholder="Enter Name" value="<?= $name; ?>" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" placeholder="Enter Email" value="<?= $email; ?>" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" placeholder="Enter Phone Number" value="<?= $phone; ?>" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="hidden" name="old_img" value="<?= $photo; ?>">
              <input type="file" name="image" class="custom-file" required>
              <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
            </div>
            <div class="form-group">
              <?php if ($update == true) { ?>
                <a href="index.php" class="btn btn-info">Cancel</a> <input type="submit" name="update" value="Update Record" class="btn btn-success">
              <?php }else{ ?>
                <input type="submit" value="Add Record" name="add" class="btn btn-primary btn-block">
              <?php } ?>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <?php

          $query = "SELECT * FROM users";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();

           ?>
          <h5 class="text-center text-info">All Records</h5>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <th scope="row"><?= $row['id']; ?></th>
                <td><img src="<?= $row['photo']; ?>" width="30"></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td>
                  <a href="details.php?details=<?= $row['id'] ?>" class="badge badge-primary p-2">Details</a> |
                  <a href="index.php?edit=<?= $row['id'] ?>" class="badge badge-success p-2">Edit</a> |
                  <a href="action.php?delete=<?= $row['id'] ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want tot delete?');">Delete</a>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
      window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    </script>
  </body>
</html>
