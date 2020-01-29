<!DOCTYPE html>
<html lang="en">
    <?php

        //NOT API AND JQUERY DUE TO LACK OF TIME
        include ((dirname(__FILE__) ).'/app/Api/base.php');

        use app\Models\Employee;

        use app\Controllers\EmployeeController;

        $employee = new EmployeeController();

        $results = $employee->get($_POST)->returnResponse();

        ?>

    <head>
        <title>Web Developer Exam | Sourcefit Philippines</title>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sourcefit.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Employee Database</h1>
            </header>
            <section id="content">
                <?php if (isset($_GET['deleted'])) { ?>
                    <label class="control-label" id="deleted">Employee successfully deleted</label>
                <?php } ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['results'] as $result)  { ?>
                        <tr>
                            <td><?php echo $result['id'] ?></td>
                            <td><?php echo $result['name'] ?></td>
                            <td><?php echo $result['address'] ?></td>
                            <td><?php echo $result['contact'] ?></td>
                            <td><a href="#"><?php echo $result['email'] ?></a></td>
                            <td><?php echo $result['birthday'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-small" href="edit.html?id=<?php echo $result['id']?>"><i class="icon-edit"></i> Edit</a>
                                    <a class="btn btn-small delete" href="app/api/user/delete.php?id=<?php echo $result['id']?>"><i class="icon-trash"></i> Delete</a>
                                    <input type="hidden" class="id" value="<?php $result['id']?>">
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row-fluid">
                    <a href="add.html" class="btn"><i class="icon-plus"></i> Add Record</a>
                </div>
            </section>
            <footer class="row show-grid">
                <div class="footer-text span12">
                    Copyright &copy; 2012 Sourcefit Philippines. All rights reserved
                </div>
            </footer>
        </div>
        <script src="js/jquery.min.js"></script>
        <script>
        $( document ).ready(function() {
            fetchRecords();

            setTimeout(function(){ 
                $('#deleted').hide(); 
            }, 4000);
        })

        function fetchRecords() {
             $.ajax({
                    url: "app/api/user/get.php",
                    type: "get",
                    success: function (response) {
                        var res = JSON.parse(response)
                    },
                    error: function(response, status, error) {

                        alert(error);

                        var resp = JSON.parse(response.responseText);

                        resp.results.forEach(function(element) {
                            $('#error_'+element['field']).text(element['message']);
                            $('#error_'+element['field']).show();
                        });
                    }
                });
        }
            
        </script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>