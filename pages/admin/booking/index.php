<?php include('../../../includes/db.php'); 

     

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../../../assets/admin/style.css" />

</head>

<body>
  
  <div class="dashboard">
    <?php include('../layout/sidebar.php'); ?>
    <div class="main-content">
      <div class="content-body">
        <div id="buses-table">
          <h2>Booking</h2>
      
          <table>
    <a href='create.php' class='btn btn-edit '>Add Booking</a>
            
            <thead>
              <tr>
               
              </tr>
            </thead>
            <tbody>
            <tr>
               
                <td>
                    <button class='btn btn-view' data-modal-id='modal-$bus_id'>View</button>
                   
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  </div>

  <script src="../../assets/admin/script.js"></script>
</body>

</html>