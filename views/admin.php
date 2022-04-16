<?php 
    if(!isset($_SESSION['admin'])) {
        http_response_code(404);
        header('Location: index.php?page=home');
        exit();

    }
include "models/categories/getGenders.php";
include "models/categories/getBrands.php";   

?>

<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark    ">
            <div class="sidebar-header bg-dark">
                <h3>Admin panel</h3>
            </div>

            <ul class="list-unstyled components bg-dark sidebarLista">
                <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Products</a>
                    <ul class="collapse list-unstyled bg-dark sidebarLista" id="homeSubmenu">
                        <li>
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=admin&ind=add">Add new  product</a>
                        </li>
                        <li>
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=admin&ind=upddel">Update/delete product</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=admin&ind=stats">Statistics</a>
                </li>
                <li>
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=admin&ind=messages">Messages</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                <a href="models/exportExcel.php" class="btn btn-outline-info mt-3">Download - Excel</a>
                </li>
                <li>
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=store" class="btn btn-outline-info mt-3">Back to products</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>
            <?php

            if(isset($_GET['ind'])){
                switch($_GET['ind'])
                {
                case 'add':
                    include "views/admin/add.php";
                    break;
                case 'upddel':
                    include "views/admin/updateDelete.php";
                    break;
                case 'stats':
                    include "views/admin/statistics.php";
                    include "views/admin/logins.php";
                    break;
                case 'messages':
                    include "views/admin/messages.php";
                    break;
                }
            }
            else{
                echo '<h2>'.$_SESSION['admin'] -> ime.', '."welcome to admin panel </h2><br>";
                echo "<p>Here you can see all statistics about page visits and change all products.</p>";
            }
            ?>
            


            </div>
    </div>