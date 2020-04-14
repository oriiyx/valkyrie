<?php

use WebsiteEntries\WebsiteEntries;

require_once 'autoFileImporter.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Valkyrie</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>


<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

             <div>
<!--                 <form action="functions/addingWebsiteEntries.php" method="post">-->
                 <form id="submit-website-addition">
                     <div class="form-group" id="form-adding-websites">
                         <div class="col-sm-12">
                            <label for="formName">Website name</label>
                         </div>
                         <div class="form-row align-items-center website-url-entry-wrap">
                             <div class="col-sm-5">
                                <input type="url" class="form-control website-url-entry" id="website-url-0" data-entry="id-0" name="website-url[]" placeholder="Enter website url">
                             </div>
                             <div class="col-sm-5">
                                 <input type="text" class="form-control website-name-entry" id="website-name-0" name="website-name[]" placeholder="Enter website name">
                             </div>
                             <div class="col-sm-2">
                                 <button type="button" class="btn btn-danger remove-me" data-remove="id-0">Remove</button>
                             </div>
                         </div>
                     </div>
                     <button id="add-more" name="add-more" class="btn btn-primary mb-2">Add More</button>
                     <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary mb-2" id="save-data-adding-websites" />
                 </form>
             </div>
        </main>
    </div>
</div>


<?php

//$test = new WebsiteEntries();
//$all_entries = $test->getAllEntries();
//var_dump($all_entries);
