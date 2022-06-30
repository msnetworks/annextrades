<?php session_start();
if(@$_SESSION['super_adm']!=''){
    
?>
    <?php include"header.php"; ?>
        <?php
            $vv = mysqli_query($conn, "SELECT * FROM registration WHERE view = '1'");
            WHILE($roq = mysqli_fetch_array($vv)){
            $conn->query("UPDATE registration SET view = '0' WHERE view='1'");
            }
            //---Queries------------
            $quy=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Seller'");
            $cntSeller = mysqli_num_rows($qry);
            $quy1=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Buyer'");
            $cntBuyer = mysqli_num_rows($qry1);
        ?>
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">User List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of User</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div id="user_login_status"></div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?> 
          <script>
          
                fetch_user_login_data();
                setInterval(function(){
                fetch_user_login_data();
                }, 3000);
                function fetch_user_login_data()
                {
                var action = "fetch_data";
                $.ajax({
                url:"controller/logindisplay.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                $('#user_login_status').html(data);
                }
                });
                }
          </script>
        <script>
            var rowCount = $('#myTable tr').length;
            $('#shw').html(rowCount);


                function myFunction() {

                    var input, filter, table, tr, td, i, txtValue;
                    
                    var x = $('input[type="radio"]:checked').val();
                    //console.log(x);
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[x];
                        if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }       
                }
            }
                

        </script>

    <?php
            } 
        else{ 
					header('location: auth/');
            } 
    ?>      